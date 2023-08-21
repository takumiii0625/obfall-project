<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
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

Route::get('/', function () {
    return view('index');
});
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
