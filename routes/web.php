<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SendMailController;


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
/*
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/

Auth::routes();

Route::get('/',[PagesController::class,'index'])->name('home');
Route::get('/about',[PagesController::class,'about'])->name('about');

Route::get('/sendemail',[SendMailController::class,'index'])->name('sendmail');
Route::post('/sendemail/send',[SendMailController::class,'send'])->name('sendmailsubmit');

Route::resource('posts',PostsController::class)->name('get','posts');

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

