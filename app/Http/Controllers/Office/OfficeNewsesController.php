<?php

namespace App\Http\Controllers\Office;

use App\Enums\PerPage;
use App\Enums\PublishList;
use App\Enums\ServiceList;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Libraries\Utils;
use App\Http\Requests\Office\News\CreateRequest;
use App\Http\Requests\Office\News\EditRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OfficeNewsesController extends Controller
{
    /**
     * お知らせ一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // フォームで使ったセッションを削除（入力途中でやめた場合を考慮）
        session()->forget(['createInputNews', 'insertNews', 'updateInputNews', 'updateNews']);

        // 公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        // 表示件数
        $assign['perPages'] = PerPage::toArray();

        // お知らせ取得（お知らせテーブル（newses）を参照し有効なレコード（deleted_atがNULL）をID降順でソートし表示する。）
        $builder = DB::table('newses')
            ->selectRaw('id')
            ->selectRaw('title')
            ->selectRaw('content')
            ->selectRaw('status')
            ->selectRaw('DATE_FORMAT(created_at, "%Y年%m月%d日") as created_at_fmt')
            ->selectRaw('DATE_FORMAT(updated_at, "%Y年%m月%d日") as updated_at_fmt')
            ->selectRaw('deleted_at')
            ->whereNull('deleted_at')->orderBy('id', 'desc');


        // タイトルのLIKE検索
        if ($request->filled('title')) {
            $builder->where('title', 'like', "%{$request->title}%");
        }

        // 内容のLIKE検索
        if ($request->filled('content')) {
            $builder->where('content', 'like', "%{$request->content}%");
        }

        // 公開ステータスのEQUAL検索
        if ($request->filled('status')) {
            $builder->where('status', $request->status);
        }

        // 表示件数を取得
        $assign['per_page'] = Utils::perPage($request->get('per_page', PerPage::Fifty->getLabel()));

        // ページネーションを設定
        $assign['records'] = $builder->paginate($assign['per_page']);

        // 検索条件をビューに渡す
        $assign['input'] = $request->all();

        // 戻るボタン用に検索条件を保管
        session(['officeNewsIndexSearchParams' => $assign['input']]);

        return view('office/newses/index', compact('assign'));
    }

    /**
     * お知らせ詳細
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        // フォームで使ったセッションを削除（入力途中でやめた場合を考慮）
        session()->forget(['createInputNews', 'insertNews', 'updateInputNews', 'updateNews']);

        // お知らせ取得（URIのidを基に、お知らせテーブル（newses）を参照し有効なレコード(deleted_at=null)を表示する。)
        $assign['record'] = DB::table('newses')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $assign['record']) {
            return redirect()->route('officeNewsIndex', session('officeNewsIndexSearchParams'))->with('error', 'お知らせが存在しません。');
        }

        // 公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        return view('office/newses/show', compact('assign'));
    }

    /**
     * お知らせ登録(入力)
     *
     * @return \Illuminate\View\View
     */
    public function createInput()
    {
        // セッションに入力値があれば初期値としてセット
        $input = session('createInputNews');
        $assign = $input ?? [];

        //　公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        return view('office/newses/create/input', compact('assign'));
    }

    /**
     * お知らせ登録(確認)
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function createConfirm(CreateRequest $request)
    {
        $input = $request->validated();

        // TODO:レコード存在チェック

        //　公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        // 画像アップロード処理
        if ($request->hasFile('news_image_url_1')) {
            $file = $request->file('news_image_url_1');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['news_image_url_1'] = 'uploads/' . $fileName;
        }
        if ($request->hasFile('news_image_url_2')) {
            $file = $request->file('news_image_url_2');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['news_image_url_2'] = 'uploads/' . $fileName;
        }
        if ($request->hasFile('news_image_url_3')) {
            $file = $request->file('news_image_url_3');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['news_image_url_3'] = 'uploads/' . $fileName;
        }

        // 確認ページ表示用に加工、登録用に加工
        foreach ($input as $key => $value) {
            switch ($key) {

                case 'status':
                    $assign['confirm'][$key] = $assign['publicStatus'][$value] ?? '';
                    $insert[$key] = $value;
                    break;

                default:
                    $assign['confirm'][$key] = $value;
                    $insert[$key] = $value;
                    break;
            }
        }

        session(['createInputNews' => $input, 'insertNews' => $insert]);

        return view('office/newses/create/confirm', compact('assign'));
    }

    /**
     * お知らせ登録(処理)
     *
     * @param  Request                           $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function createExecute(Request $request)
    {
        // 書き直し処理
        if ($request->back) {
            return redirect()->route('officeNewsCreateInput')->withInput(session('createInputNews'));
        }

        // TODO:レコード存在チェック

        $request->session()->regenerateToken();

        // insert用入力値
        $insert = session('insertNews');

        try {
            DB::beginTransaction();

            // 登録
            DB::table('newses')->insert($insert);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeNewsCreateInput')->withInput(session('createInputNews'))->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");

            return redirect()->route('officeNewsCreateInput')->withInput(session('createInputNews'))->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeNewsCreateComplete');
    }

    /**
     * お知らせ登録（完了）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function createComplete(Request $request)
    {
        // フォームで使ったセッションを削除
        session()->forget(['createInputNews', 'insertNews']);

        $assign = [];

        return view('office/newses/create/complete', compact('assign'));
    }



    /**
     * お知らせ編集（入力）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function editInput(Request $request, $id)
    {
        // セッションに入力値があれば初期値としてセット
        $input = session('updateInputNews', []); // セッションの値が null の場合、空配列をセット

        // お知らせ取得
        $assign['record'] = DB::table('newses')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $assign['record']) {
            return redirect()->route('officeNewsIndex', session('officeNewsIndexSearchParams'))->with('error', 'お知らせが存在しません。');
        }

        // セッションに `image_url` があれば、$assign['record']->image_url を上書き
        if (!empty($input['news_image_url_1'])) {
            $assign['record']->image_url = $input['news_image_url_1'];
        }
        if (!empty($input['news_image_url_2'])) {
            $assign['record']->image_url_2 = $input['news_image_url_2'];
        }
        if (!empty($input['news_image_url_3'])) {
            $assign['record']->image_url_3 = $input['news_image_url_3'];
        }

        //　公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        return view('office/newses/edit/input', compact('assign'));
    }

    /**
     * お知らせ編集（確認）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function editConfirm(EditRequest $request, $id)
    {
        $input = $request->validated();

        // お知らせ取得
        $assign['record'] = DB::table('newses')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $assign['record']) {
            return redirect()->route('officeNewsIndex', session('officeNewsIndexSearchParams'))->with('error', 'お知らせが存在しません。');
        }

        // TODO:ユニークチェック


        // ★画像削除チェック処理（ここを追加）
        if ($request->filled('delete_news_image_url_1') && $request->delete_news_image_url_1 == '1') {
            if (!empty($assign['record']->news_image_url_1) && file_exists(public_path($assign['record']->news_image_url_1))) {
                unlink(public_path($assign['record']->news_image_url_1));
            }
            $input['news_image_url_1'] = null;
        }

        if ($request->filled('delete_news_mage_url_2') && $request->delete_news_image_url_2 == '1') {
            if (!empty($assign['record']->news_image_url_2) && file_exists(public_path($assign['record']->news_image_url_2))) {
                unlink(public_path($assign['record']->news_image_url_2));
            }
            $input['news_image_url_2'] = null;
        }

        if ($request->filled('delete_news_image_url_3') && $request->delete_news_image_url_3 == '1') {
            if (!empty($assign['record']->news_image_url_3) && file_exists(public_path($assign['record']->news_image_url_3))) {
                unlink(public_path($assign['record']->news_image_url_3));
            }
            $input['news_image_url_3'] = null;
        }

        // 画像アップロード処理
        if ($request->hasFile('news_image_url_1')) {
            $file = $request->file('news_image_url_1');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['news_image_url_1'] = 'uploads/' . $fileName;
        }
        if ($request->hasFile('news_image_url_2')) {
            $file = $request->file('news_image_url_2');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['news_image_url_2'] = 'uploads/' . $fileName;
        }
        if ($request->hasFile('news_image_url_3')) {
            $file = $request->file('news_image_url_3');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['news_image_url_3'] = 'uploads/' . $fileName;
        }

        //　公開ステータス
        $assign['publicStatus'] = PublishList::toArray();


        // 確認ページ表示用に加工、登録用に加工
        foreach ($input as $key => $value) {
            switch ($key) {

                case 'status':
                    $assign['confirm'][$key] = $assign['publicStatus'][$value] ?? '';
                    $update[$key] = $value;
                    break;

                default:
                    $assign['confirm'][$key] = $value;
                    $update[$key] = $value;
                    break;
            }
        }

        session(['updateInputNews' => $input, 'updateNews' => $update]);

        return view('office/newses/edit/confirm', compact('assign'));
    }

    /**
     * お知らせ編集（処理）
     *
     * @param  Request                           $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function editExecute(Request $request, $id)
    {
        // 書き直し処理
        if ($request->back) {
            return redirect()->route('officeNewsEditInput', ['id' => $id])->withInput(session('updateInputNews'));
        }

        // お知らせ取得
        $record = DB::table('newses')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $record) {
            return redirect()->route('officeNewsIndex', session('officeNewsIndexSearchParams'))->with('error', 'お知らせが存在しません。');
        }

        // TODO:ユニークチェック

        $request->session()->regenerateToken();

        // update用入力値
        $update = session('updateNews');

        try {
            DB::beginTransaction();

            // 更新
            DB::table('newses')->where('id', $id)->whereNull('deleted_at')->update($update);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeNewsEditInput', ['id' => $id])->withInput(session('updateInputNews'))->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");

            return redirect()->route('officeNewsEditInput', ['id' => $id])->withInput(session('updateInputNews'))->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeNewsEditComplete', ['id' => $id]);
    }

    /**
     * お知らせ編集（完了）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function editComplete(Request $request, $id)
    {
        // フォームで使ったセッションを削除
        session()->forget(['updateInputNews', 'updateNews']);

        $assign['id'] = $id;
        return view('office/newses/edit/complete', compact('assign'));
    }

    /**
     * お知らせ削除（処理）
     *
     * @param  Request                           $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteExecute(Request $request, $id)
    {
        $request->session()->regenerateToken();

        try {
            DB::beginTransaction();

            // 削除
            DB::table('newses')->where('id', $id)->update(['deleted_at' => Carbon::now()]);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeNewsIndex', session('officeNewsIndexSearchParams'))->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");
            return redirect()->route('officeNewsIndex', session('officeNewsIndexSearchParams'))->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeNewsIndex', session('officeNewsIndexSearchParams'))->with('success', '削除しました。');
    }
}
