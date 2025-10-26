<?php

namespace App\Http\Controllers\User;

use App\Enums\PerPage;
use App\Enums\PublishList;
use App\Enums\ServiceList;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Libraries\Utils;
use App\Http\Requests\User\News\CreateRequest;
use App\Http\Requests\User\News\EditRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserNewsesController extends Controller
{

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
        $assign['record'] = DB::table('newses')->where('id', $id)->select('id', 'title', 'content', 'news_image_url_1', 'news_image_url_2', 'news_image_url_3', 'status', 'deleted_at')
            ->selectRaw('DATE_FORMAT(created_at, "%Y年%m月%d日") as created_at_fmt')->whereNull('deleted_at')->first();

        if (! $assign['record']) {
            return redirect()->route('userNewsIndex', session('userNewsIndexSearchParams'))->with('error', 'お知らせが存在しません。');
        }

        // 公開ステータス
        $assign['publicStatus'] = PublishList::toArray();

        return view('user/newses/show', compact('assign'));
    }

    /**
     * お知らせ一覧
     *
     * @param  Request               $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        // フォームで使ったセッションを削除（入力途中でやめた場合を考慮）
        session()->forget(['createInputNews', 'insertNews', 'updateInputNews', 'updateNews']);

        // お知らせ一覧取得（お知らせテーブル（newses）を参照し有効なレコード(deleted_at=null、status=1)を表示する。)
        $query = DB::table('newses')
            ->select('id', 'title', 'content', 'news_image_url_1', 'status', 'deleted_at')
            ->selectRaw('DATE_FORMAT(created_at, "%Y年%m月%d日") as created_at_fmt')
            ->where('status', 1) // 公開中のみ
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc');

        // ページネーション
        $newsList = $query->paginate(PerPage::NEWS_LIST); // ここは10件
        $newsList->appends(request()->query());           // クエリ引き継ぎ
        $assign['newsList'] = $newsList;

        return view('user/newses/index', compact('assign'));
    }
}
