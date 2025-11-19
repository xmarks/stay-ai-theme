<?php

use App\Http\Controllers\{BlogController, CaseStudyController,ResourceController};
use App\Http\Middleware\VerifyWPNonce;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware( VerifyWPNonce::class )->group( function () {
    Route::group( ['prefix' => 'resources', 'as' => 'resources.'], function () {
        Route::get( '/', [ResourceController::class, 'get_posts'] )->name( 'posts' );
    } );

    Route::group( ['prefix' => 'blog', 'as' => 'blog.'], function () {
        Route::get( '/', [BlogController::class, 'get_posts'] )->name( 'posts' );
    } );

    Route::group( ['prefix' => 'case_studies', 'as' => 'case_studies.'], function () {
        Route::get( '/', [CaseStudyController::class, 'get_posts'] )->name( 'posts' );
    } );
} );
