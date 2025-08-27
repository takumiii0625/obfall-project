<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class TopController extends Controller
{
    /**
     * Display the top page.
     *
     * @return \Illuminate\View\View
     */


    public function indexDev()
    {
        // お知らせ取得（お知らせテーブル（newses）を参照し有効なレコード(deleted_at=null、status=1)を表示する。)
        $assign['news'] = DB::table('newses')
            ->select('id', 'title', 'content', 'news_image_url_1', 'status', 'deleted_at')
            ->selectRaw('DATE_FORMAT(created_at, "%Y年%m月%d日") as created_at_fmt')
            ->where('status', 1) // 公開中のみ
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->get();

        // 自社開発取得（自社開発テーブル（inhouse_developments）を参照し有効なレコード(deleted_at=null、status=1)を表示する。)
        $assign['inhouse_developments'] = DB::table('inhouse_developments')
            ->select('id', 'category', 'title', 'content', 'inhouse_developments_image_url', 'inhouse_developments_home_page_url', 'status', 'notes')
            ->selectRaw('DATE_FORMAT(created_at, "%Y年%m月%d日") as created_at_fmt')
            ->where('status', 1) // 公開中のみ
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->get();

        return view('indexDev', compact('assign'));
    }
    public function index()
    {

        // 自社開発取得（自社開発テーブル（inhouse_developments）を参照し有効なレコード(deleted_at=null、status=1)を表示する。)
        $assign['inhouse_developments'] = DB::table('inhouse_developments')
            ->select('id', 'category', 'title', 'content', 'inhouse_developments_image_url', 'inhouse_developments_home_page_url', 'status', 'notes')
            ->selectRaw('DATE_FORMAT(created_at, "%Y年%m月%d日") as created_at_fmt')
            ->where('status', 1) // 公開中のみ
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->get();

        return view('index', compact('assign'));
    }
}
