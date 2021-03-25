<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OauthController;


Route::group(['middleware' => ['web']], function () {
    Route::post('/contact', function(){
        return 'route';
    });
      
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/explicador', [OauthController::class, 'redirectToExplicador']);
Route::get('/auth/explicador/callback', [OauthController::class, 'handleExplicadorCallback']);

Route::get('/auth/google', [App\Http\Controllers\OauthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [App\Http\Controllers\OauthController::class, 'handleGoogleCallback']);

Route::get('/auth/linkedin', [App\Http\Controllers\OauthController::class, 'redirectToLinkedin']);
Route::get('/auth/linkedin/callback', [App\Http\Controllers\OauthController::class, 'handleLinledinCallback']);

Route::get('/auth/facebook', [App\Http\Controllers\OauthController::class, 'redirectToFacebook']);
Route::get('/auth/facebook/callback', [App\Http\Controllers\OauthController::class, 'handleFacebookCallback']);

Route::get('/auth/github', [App\Http\Controllers\OauthController::class, 'redirectToGithub']);
Route::get('/auth/github/callback', [App\Http\Controllers\OauthController::class, 'handleGithubCallback']);
});

