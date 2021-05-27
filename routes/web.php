<?php

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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
Route::resources([
    'users' => App\Http\Controllers\UserController::class,
]);
Route::get('/UsersServerSide',[App\Http\Controllers\UserController::class, 'GetAllUsers'])->name('users.showall');

Route::resources([
    'announcements' => App\Http\Controllers\AnnouncementController::class,
]);
Route::get('/AnnouncementsServerSide',[App\Http\Controllers\AnnouncementController::class, 'GetAllAnnouncements'])->name('announcements.showall');


Route::get('/', function () {
    $announcements = Announcement::orderBy('created_at','desc')->get();
    return view('announcements_show',compact('announcements'));
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
