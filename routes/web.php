<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
//admin controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Models\Movie;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}',[IndexController::class, 'category'])->name('category');
Route::get('/quoc-gia/{slug}',[IndexController::class, 'country'])->name('country');
Route::get('/the-loai/{slug}',[IndexController::class, 'genre'])->name('genre');

Route::get('/phim/{slug}',[IndexController::class, 'movie'])->name('movie');
Route::get('/tap-phim',[IndexController::class, 'episode'])->name('episode');
Route::get('/xem-phim/{slug}',[IndexController::class, 'watch'])->name('watch');
Route::get('/xem-phim/{slug}/tap-{episode}', [IndexController::class, 'watchEpisode'])->name('watch.episode');
Route::get('/xem-phim/{slug}/trailer', [IndexController::class, 'watchTrailer'])->name('watch.trailer');
Route::get('/tim-kiem',[IndexController::class, 'search'])->name('search');
Route::get('/cap-nhat-phim/{slug}',[IndexController::class, 'updateMovie'])->name('updateMovie');
Route::get('/them-phim',[IndexController::class, 'addMovie'])->name('addMovie');
Route::get('/them-phim-moi',[IndexController::class, 'addNewMovie'])->name('addNewMovie');

Route::get('/tag/{tag}',[IndexController::class, 'tag']);


Auth::routes();


//route admin
Route::middleware(['check.login'])->group(function () {
    // Các route hoặc controller yêu cầu đăng nhập sẽ được đặt ở đây
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/category', CategoryController::class);
    Route::post('resorting', [CategoryController::class,'resorting'])->name('resorting');
    
    
    Route::resource('/genre', GenreController::class);
    Route::resource('/country', CountryController::class);
    Route::resource('/movie', MovieController::class);
    Route::get('/createFormAPI', [MovieController::class, 'createFormAPI'])->name('movie.createFormAPI');
    Route::get('/createDetailsAPI', [MovieController::class, 'createDetailsAPI'])->name('movie.createDetailsAPI');
    
    Route::resource('/episode', EpisodeController::class);
    Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');

});


