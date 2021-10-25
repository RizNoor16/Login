<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Controllers\PageSectionController;
use App\Http\Models\PageSection;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});
//Route::post('/content', 'ContentController@create');

Route::resource('content', ContentController::class );

Route::post('uploading-file-api', [FileUploadController::class, 'upload']);

Route::post('page-section/{page_id}', [PageSectionController::class, 'storePageSectionInfo']);
Route::get('page-section-details/{page_id}', [PageSectionController::class, 'getPageSection']);
Route::get('cms-type', [PageSectionController::class, 'getCmsType']);

//Route::resource('page-section', PageSectionController::class );

// Route::get('page-section', 'PageSectionController@getAllPageSection');