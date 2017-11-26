<?php

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

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


Route::get('/','SiteController@index')->name('home');

Route::get('/recipe/{recipid}/{slug}', 'SiteController@recipe')->name('single');

Route::get('/search/{query}','SearchController@search');

Route::get('/auth/login','AuthController@login')->name('login');
Route::post('/auth/login','AuthController@login_post');

Route::get('/auth/logout', function() { \Auth::logout(); return Redirect::to('/'); });


Route::get('/refer/{email}/{token}','SiteController@postRefer');
Route::post('/refer/{email}/{token}','SiteController@postReferComplete');



Route::get('/todo', function() {
    return view('todo');
});

Route::group(['middleware' => ['auth']], function() {


    Route::get('/recipes/mine','SiteController@getMyRecipes')->name('mine');
    Route::get('/recipes/share','SiteController@share')->name('share');
    Route::post('/recipes/share','SiteController@share_post');

    Route::post('/refer','SiteController@refer');


    Route::post('/like/add', function(Request $request) {

        return response()->json($request);

    });




    Route::post('/upload', function(Request $request) {
        $img = Image::make($_FILES['file']['tmp_name']);
        $img->save($_SERVER['DOCUMENT_ROOT'].'/uploads/lg/'.$_FILES['file']['name']);

        $img = Image::make($_FILES['file']['tmp_name'])->resize(350, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($_SERVER['DOCUMENT_ROOT'].'/uploads/md/'.$_FILES['file']['name']);

        $img = Image::make($_FILES['file']['tmp_name'])->resize(100, null, function($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($_SERVER['DOCUMENT_ROOT'].'/uploads/sm/'.$_FILES['file']['name']);

        //$lastId = \App\Recipe::select('id')->orderby('id','desc')->first();

        $m = new \App\Media;
        $m->media_filename = $_FILES['file']['name'];
        $m->media_recipeid = $request->get('media_recipeid');

        $m->save();

        //move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/uploads/lg/'.$_FILES['file']['name']);
    });
});
