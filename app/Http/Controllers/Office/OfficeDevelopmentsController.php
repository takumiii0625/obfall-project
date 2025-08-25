<?php

namespace App\Http\Controllers\Office;

use App\Enums\PerPage;
use App\Enums\PublishList;
use App\Enums\ServiceList;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Libraries\Utils;
use App\Http\Requests\Office\Developments\CreateRequest;
use App\Http\Requests\Office\Developments\EditRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OfficeDevelopmentsController extends Controller
{
    /**
     * 自社開発一覧
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // フォームで使ったセッションを削除（入力途中でやめた場合を考慮）
        session()->forget(['createInputDevelopments', 'insertDevelopments', 'updateInputDevelopments', 'updateDevelopments']);

        // 公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        // 表示件数
        $assign['perPages'] = PerPage::toArray();

        // 自社開発取得（自社開発テーブル（inhouse_developments）を参照し有効なレコード（deleted_atがNULL）をID降順でソートし表示する。）
        $builder = DB::table('inhouse_developments')
            ->selectRaw('id')
            ->selectRaw('category')
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
        session(['officeDevelopmentsIndexSearchParams' => $assign['input']]);

        return view('office/inhouse_developments/index', compact('assign'));
    }

    /**
     * 自社開発詳細
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        // フォームで使ったセッションを削除（入力途中でやめた場合を考慮）
        session()->forget(['createInputDevelopments', 'insertDevelopments', 'updateInputDevelopments', 'updateDevelopments']);

        // 自社開発取得（URIのidを基に、自社開発テーブル（inhouse_developments）を参照し有効なレコード(deleted_at=null)を表示する。)
        $assign['record'] = DB::table('inhouse_developments')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $assign['record']) {
            return redirect()->route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams'))->with('error', '自社開発が存在しません。');
        }

        // 公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        return view('office/inhouse_developments/show', compact('assign'));
    }

    /**
     * 自社開発登録(入力)
     *
     * @return \Illuminate\View\View
     */
    public function createInput()
    {
        // セッションに入力値があれば初期値としてセット
        $input = session('createInputDevelopments');
        $assign = $input ?? [];

        //　公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        return view('office/inhouse_developments/create/input', compact('assign'));
    }

    /**
     * 自社開発登録(確認)
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
        if ($request->hasFile('inhouse_developments_image_url')) {
            $file = $request->file('inhouse_developments_image_url');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['inhouse_developments_image_url'] = 'uploads/' . $fileName;
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

        session(['createInputDevelopments' => $input, 'insertDevelopments' => $insert]);

        return view('office/inhouse_developments/create/confirm', compact('assign'));
    }

    /**
     * 自社開発登録(処理)
     *
     * @param  Request                           $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function createExecute(Request $request)
    {
        // 書き直し処理
        if ($request->back) {
            return redirect()->route('officeDevelopmentsCreateInput')->withInput(session('createInputDevelopments'));
        }

        // TODO:レコード存在チェック

        $request->session()->regenerateToken();

        // insert用入力値
        $insert = session('insertDevelopments');

        try {
            DB::beginTransaction();

            // 登録
            DB::table('inhouse_developments')->insert($insert);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeDevelopmentsCreateInput')->withInput(session('createInputDevelopments'))->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");

            return redirect()->route('officeDevelopmentsCreateInput')->withInput(session('createInputDevelopments'))->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeDevelopmentsCreateComplete');
    }

    /**
     * 自社開発登録（完了）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function createComplete(Request $request)
    {
        // フォームで使ったセッションを削除
        session()->forget(['createInputDevelopments', 'insertDevelopments']);

        $assign = [];

        return view('office/inhouse_developments/create/complete', compact('assign'));
    }



    /**
     * 自社開発編集（入力）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function editInput(Request $request, $id)
    {
        // セッションに入力値があれば初期値としてセット
        $input = session('updateInputDevelopments', []); // セッションの値が null の場合、空配列をセット

        // 自社開発取得
        $assign['record'] = DB::table('inhouse_developments')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $assign['record']) {
            return redirect()->route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams'))->with('error', '自社開発が存在しません。');
        }

        // セッションに `image_url` があれば、$assign['record']->image_url を上書き
        if (!empty($input['inhouse_developments_image_url'])) {
            $assign['record']->image_url = $input['inhouse_developments_image_url'];
        }

        //　公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        return view('office/inhouse_developments/edit/input', compact('assign'));
    }

    /**
     * 自社開発編集（確認）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function editConfirm(EditRequest $request, $id)
    {
        $input = $request->validated();

        // 自社開発取得
        $assign['record'] = DB::table('inhouse_developments')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $assign['record']) {
            return redirect()->route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams'))->with('error', '自社開発が存在しません。');
        }

        // TODO:ユニークチェック


        // ★画像削除チェック処理（ここを追加）
        if ($request->filled('delete_inhouse_developments_image_url') && $request->delete_inhouse_developments_image_url == '1') {
            if (!empty($assign['record']->inhouse_developments_image_url) && file_exists(public_path($assign['record']->inhouse_developments_image_url))) {
                unlink(public_path($assign['record']->inhouse_developments_image_url));
            }
            $input['inhouse_developments_image_url'] = null;
        }


        // 画像アップロード処理
        if ($request->hasFile('inhouse_developments_image_url')) {
            $file = $request->file('inhouse_developments_image_url');
            $fileName = time() . '_' . $file->getClientOriginalName(); // 重複防止

            // public/uploads に保存
            $file->move(public_path('uploads'), $fileName);

            // Blade で asset('uploads/xxx.jpg') で表示するためのパス
            $input['inhouse_developments_image_url'] = 'uploads/' . $fileName;
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

        session(['updateInputDevelopments' => $input, 'updateDevelopments' => $update]);

        return view('office/inhouse_developments/edit/confirm', compact('assign'));
    }

    /**
     * 自社開発編集（処理）
     *
     * @param  Request                           $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function editExecute(Request $request, $id)
    {
        // 書き直し処理
        if ($request->back) {
            return redirect()->route('officeDevelopmentsEditInput', ['id' => $id])->withInput(session('updateInputDevelopments'));
        }

        // 自社開発取得
        $record = DB::table('inhouse_developments')->where('id', $id)->whereNull('deleted_at')->first();
        if (! $record) {
            return redirect()->route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams'))->with('error', '自社開発が存在しません。');
        }

        // TODO:ユニークチェック

        $request->session()->regenerateToken();

        // update用入力値
        $update = session('updateDevelopments');

        try {
            DB::beginTransaction();

            // 更新
            DB::table('inhouse_developments')->where('id', $id)->whereNull('deleted_at')->update($update);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeDevelopmentsEditInput', ['id' => $id])->withInput(session('updateInputDevelopments'))->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");

            return redirect()->route('officeDevelopmentsEditInput', ['id' => $id])->withInput(session('updateInputDevelopments'))->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeDevelopmentsEditComplete', ['id' => $id]);
    }

    /**
     * 自社開発編集（完了）
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function editComplete(Request $request, $id)
    {
        // フォームで使ったセッションを削除
        session()->forget(['updateInputDevelopments', 'updateDevelopments']);

        $assign['id'] = $id;
        return view('office/inhouse_developments/edit/complete', compact('assign'));
    }

    /**
     * 自社開発削除（処理）
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
            DB::table('inhouse_developments')->where('id', $id)->update(['deleted_at' => Carbon::now()]);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            $params = implode(', ', $e->getBindings());
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . "\nSQL: {$e->getSql()}\nParams: {$params}\n{$e}\n\n");

            return redirect()->route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams'))->with('error', 'データベースエラーが発生しました。時間をおいて再度お試しください。');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('ERROR' . __METHOD__ . '#' . __LINE__ . " >>> {$e}\n\n");
            return redirect()->route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams'))->with('error', '予期せぬエラーが発生しました。時間をおいて再度お試しください。');
        }

        return redirect()->route('officeDevelopmentsIndex', session('officeDevelopmentsIndexSearchParams'))->with('success', '削除しました。');
    }
}
