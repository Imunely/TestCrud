<?php

use App\Http\Controllers\Api\v1\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(LoginController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});



        
Route::middleware('auth:sanctum')->group( function () {

    Route::group(['prefix' => 'v1'], function () {

        Route::get('books/list', [BookController::class, 'list']);

        Route::get('books/get/{id}', [BookController::class, 'get']);

        Route::post('books/update/{book}', [BookController::class, 'update']);

        Route::delete('books/delete/{id}', [BookController::class, 'delete']);
    
    });
});

