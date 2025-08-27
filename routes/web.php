<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\TopController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Office\OfficeAuthController;
use App\Http\Controllers\Office\OfficeNewsesController;
use App\Http\Controllers\User\UserServicesController;
use App\Http\Controllers\Office\OfficeDevelopmentsController;
use App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Middleware\RedirectIfNoUser;
use App\Http\Controllers\User\UserNewsesController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


*/

// Route::get('/', function () {
//     return view('index');
// })->name('index');

Route::get('/', [TopController::class, 'index'])->name('index');

Route::get('/dev', [TopController::class, 'indexDev'])->name('indexDev');

// お知らせ詳細
Route::get('/newses/{id}', [UserNewsesController::class, 'show'])->name('userNewsShow')->setDefaults(['description' => 'お知らせ詳細']);
// サービス
Route::get('/service', [UserServicesController::class, 'show'])->name('userServicesShow')->setDefaults(['description' => 'サービス詳細']);

// 会社概要
Route::get('/aboutus', function () {
    return view('user/aboutuses/show');
})->name('aboutus');

// 企業理念
Route::get('/concepts', function () {
    return view('user/concepts/show');
})->name('concept');



//トップページ
Route::get('/contact', [ContactsController::class, 'contact'])->name('contact');
//確認ページ
//Route::get('/confirm', [CotactController::class, 'confirm']);
Route::post('/confirm', [ContactsController::class, 'confirm'])->name('confirm');
//送信完了ページ
Route::get('/complete', [ContactsController::class, 'complete'])->name('complete');

Route::post('/process', [ContactsController::class, 'process'])->name('process');

Route::get('/privacy-policy', function () {
    return view('privacy_policy');
})->name('privacy-policy');


Route::middleware([RedirectIfAuthenticated::class . ':office'])->group(function () {
    // 管理者初期アカウント設定（入力）
    Route::get('/init/input', [OfficeAuthController::class, 'initInput'])->name('officeInitInput');
    // 管理者初期アカウント設定（処理）
    Route::post('/init/complete', [OfficeAuthController::class, 'initExecute'])->name('officeInitExecute');
    // 管理者初期アカウント設定（完了）
    Route::get('/init/complete', [OfficeAuthController::class, 'initComplete'])->name('officeInitComplete');

    // 管理者パスワードを忘れたら（入力）
    Route::get('/office/forgot/pw/input', [OfficeAuthController::class, 'forgotPwInput'])->name('officeForgotPwInput');
    // 管理者パスワードを忘れたら（処理）
    Route::post('/office/forgot/pw/complete', [OfficeAuthController::class, 'forgotPwExecute'])->name('officeForgotPwExecute');
    // 管理者パスワードを忘れたら（完了）
    Route::get('/office/forgot/pw/complete', [OfficeAuthController::class, 'forgotPwComplete'])->name('officeForgotPwComplete');

    // 管理者パスワード設定（入力）
    Route::get('/office/set/pw/input', [OfficeAuthController::class, 'setPwInput'])->name('officeSetPwInput');
    // 管理者パスワード設定（処理）
    Route::post('/office/set/pw/complete', [OfficeAuthController::class, 'setPwExecute'])->name('officeSetPwExecute');
    // 管理者パスワード設定（完了）
    Route::get('/office/set/pw/complete', [OfficeAuthController::class, 'setPwComplete'])->name('officeSetPwComplete');

    // 管理者ログイン（入力）
    Route::get('/office/login', [OfficeAuthController::class, 'loginInput'])->name('officeLoginInput');
    // 管理者ログイン（処理）
    Route::post('/office/login', [OfficeAuthController::class, 'loginExecute'])->name('officeLoginExecute');

    // 管理者ワンタイムキー（入力）
    Route::get('/onetime/input', [OfficeAuthController::class, 'onetimeInput'])->name('officeOnetimeInput');
    // 管理者ワンタイムキー（処理）
    Route::post('/onetime/complete', [OfficeAuthController::class, 'onetimeExecute'])->name('officeOnetimeExecute');
});
Route::middleware([RedirectIfNotAuthenticated::class . ':office', RedirectIfNoUser::class . ':office'])->group(function () {

    // お知らせ一覧
    Route::get('/newses', [OfficeNewsesController::class, 'index'])->name('officeNewsIndex')->setDefaults(['description' => 'お知らせ一覧']);

    // お知らせ詳細
    Route::get('/admins/newses/{id}', [OfficeNewsesController::class, 'show'])->name('officeNewsShow')->setDefaults(['description' => 'お知らせ詳細']);

    // お知らせ登録（入力）
    Route::get('/newses/create/input', [OfficeNewsesController::class, 'createInput'])->name('officeNewsCreateInput')->setDefaults(['description' => 'お知らせ登録']);
    // お知らせ登録（確認）
    Route::post('/newses/create/confirm', [OfficeNewsesController::class, 'createConfirm'])->name('officeNewsCreateConfirm');
    // お知らせ登録（処理）
    Route::post('/newses/create/complete', [OfficeNewsesController::class, 'createExecute'])->name('officeNewsCreateExecute');
    // お知らせ登録（完了）
    Route::get('/newses/create/complete', [OfficeNewsesController::class, 'createComplete'])->name('officeNewsCreateComplete');

    // お知らせ編集（入力）
    Route::get('/newses/{id}/edit/input', [OfficeNewsesController::class, 'editInput'])->name('officeNewsEditInput')->setDefaults(['description' => 'お知らせ編集']);
    // お知らせ編集（確認）
    Route::post('/newses/{id}/edit/confirm', [OfficeNewsesController::class, 'editConfirm'])->name('officeNewsEditConfirm');
    // お知らせ編集（処理）
    Route::post('/newses/{id}/edit/complete', [OfficeNewsesController::class, 'editExecute'])->name('officeNewsEditExecute');
    // お知らせ編集（完了）
    Route::get('/newses/{id}/edit/complete', [OfficeNewsesController::class, 'editComplete'])->name('officeNewsEditComplete');

    // お知らせ削除（処理）
    Route::post('/newses/{id}/delete', [OfficeNewsesController::class, 'deleteExecute'])->name('officeNewsDeleteExecute')->setDefaults(['description' => 'お知らせ削除']);

    // 自社開発一覧
    Route::get('/inhouse_developments', [OfficeDevelopmentsController::class, 'index'])->name('officeDevelopmentsIndex')->setDefaults(['description' => '自社開発一覧']);

    // 自社開発詳細
    Route::get('/inhouse_developments/{id}', [OfficeDevelopmentsController::class, 'show'])->name('officeDevelopmentsShow')->setDefaults(['description' => '自社開発詳細']);
    // 自社開発登録（入力）
    Route::get('/inhouse_developments/create/input', [OfficeDevelopmentsController::class, 'createInput'])->name('officeDevelopmentsCreateInput')->setDefaults(['description' => '自社開発登録']);
    // 自社開発登録（確認）
    Route::post('/inhouse_developments/create/confirm', [OfficeDevelopmentsController::class, 'createConfirm'])->name('officeDevelopmentsCreateConfirm');
    // 自社開発登録（処理）
    Route::post('/inhouse_developments/create/complete', [OfficeDevelopmentsController::class, 'createExecute'])->name('officeDevelopmentsCreateExecute');
    // 自社開発登録（完了）
    Route::get('/inhouse_developments/create/complete', [OfficeDevelopmentsController::class, 'createComplete'])->name('officeDevelopmentsCreateComplete');
    // 自社開発編集（入力）
    Route::get('/inhouse_developments/{id}/edit/input', [OfficeDevelopmentsController::class, 'editInput'])->name('officeDevelopmentsEditInput')->setDefaults(['description' => '自社開発編集']);
    // 自社開発編集（確認）
    Route::post('/inhouse_developments/{id}/edit/confirm', [OfficeDevelopmentsController::class, 'editConfirm'])->name('officeDevelopmentsEditConfirm');
    // 自社開発編集（処理）
    Route::post('/inhouse_developments/{id}/edit/complete', [OfficeDevelopmentsController::class, 'editExecute'])->name('officeDevelopmentsEditExecute');
    // 自社開発編集（完了）
    Route::get('/inhouse_developments/{id}/edit/complete', [OfficeDevelopmentsController::class, 'editComplete'])->name('officeDevelopmentsEditComplete');
    // 自社開発削除（処理）
    Route::post('/inhouse_developments/{id}/delete', [OfficeDevelopmentsController::class, 'deleteExecute'])->name('officeDevelopmentsDeleteExecute')->setDefaults(['description' => '自社開発削除']);
});

// 管理者ログアウト
Route::get('/office/logout', [OfficeAuthController::class, 'logout'])->name('officeLogout');
