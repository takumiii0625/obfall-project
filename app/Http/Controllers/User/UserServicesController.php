<?php

namespace App\Http\Controllers\User;

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

class UserServicesController extends Controller
{
    /**
     * サービス一覧
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        // 自社開発取得（自社開発テーブル（inhouse_developments）を参照し有効なレコード(deleted_at=null、status=1)を表示する。)
        $assign['inhouse_developments'] = DB::table('inhouse_developments')
            ->select('id', 'category', 'title', 'content', 'inhouse_developments_image_url', 'inhouse_developments_home_page_url', 'status', 'notes')
            ->selectRaw('DATE_FORMAT(created_at, "%Y年%m月%d日") as created_at_fmt')
            ->where('status', 1) // 公開中のみ
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->get();

        return view('user/services/show', compact('assign'));
    }
}
