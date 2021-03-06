<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\MenuController as menuController;
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

//WEBSITE
Route::get('/', "IndexController@index");

//ADMIN
Route::prefix("admin")->group(function () {
    Route::get('/',"IndexController@admin")->middleware('auth');
    Route::get('/menus',"MenuController@list")->middleware('auth');
    Route::get('/sliders',"SliderController@list")->middleware('auth');
    Route::get('/pages',"PageController@list")->middleware('auth');
    Route::get("/gallery","GalleryController@list")->middleware('auth'); 
    Route::get("/settings","SettingsController@list")->middleware('auth');
    Route::get("/teachers","TeachersController@list")->middleware('auth'); 
    Route::get("/meta","TeachersMeta@list")->middleware('auth'); 
    Route::get("/lang","Website_languagesController@list")->middleware('auth');
    Route::get("/news","NewsController@list")->middleware('auth');
    Route::get("/advertisements","AdvertisementsController@list")->middleware('auth');
    Route::get("/events","EventsController@list")->middleware('auth');
    Route::get("/events_categories","Events_categoriesController@list")->middleware('auth');
    Route::get("/menus","MenuController@list")->middleware('auth');
    Route::get('manage-menus/{id?}',[menuController::class,'index']);
    Route::post('create-menu',[menuController::class,'store']);	
    Route::get('add-categories-to-menu',[menuController::class,'addCatToMenu']);
    Route::get('add-post-to-menu',[menuController::class,'addPostToMenu']);
    Route::get('add-custom-link',[menuController::class,'addCustomLink']);	
    Route::get('update-menu',[menuController::class,'updateMenu']);	
    Route::post('update-menuitem/{id}',[menuController::class,'updateMenuItem']);
    Route::get('delete-menuitem/{id}/{key}/{in?}',[menuController::class,'deleteMenuItem']);
    Route::get('delete-menu/{id}',[menuController::class,'destroy']);	
    Route::get("/news_categories","News_categoriesController@list")->middleware('auth');
    Route::get("/advertisements_categories","Advertisements_categoriesController@list")->middleware('auth');
    Route::get("/tags","IndexController@tags")->middleware('auth');
    Route::get("/pages-manage","PageController@list")->middleware('auth');
    Route::post("/page/save","PageController@save")->middleware('auth');
    Route::get("/view","PageController@viewAdmin")->middleware('auth');
    Route::get("/contentbuilder","PageController@contentbuilder")->middleware('auth');
    Route::get('logout/', ['as' => 'logout', 'uses' => 'UsersController@destroy']);  
   

});
Route::get('/dataPageAction',"IndexController@dataPageAction")->middleware('auth');
Route::post('/dataPageAction',"IndexController@dataPageActionPost")->middleware('auth');
Route::get('/change_password', "UsersController@change_password")->middleware('auth');
Route::post('/change_password', "UsersController@change_password_post")->middleware('auth');
Route::get('/login',"IndexController@login");
Route::post('login/', ['as' => 'login', 'uses' => 'UsersController@login']);

Route::get("/staff/{slug}", "TeachersController@teacher");
Route::get("/staff", function() {return view("website.static.muellimler");});
Route::post("/staff/filter", "TeachersController@filter");
Route::get("/lang/{lang}", "LangController@change");
Route::get("/image/{id}", "ImageController@show");
//HELPERS

Route::get("/new/{slug}", "NewsController@show");
Route::get("/advertisement/{slug}", "AdvertisementsController@show");
Route::get("/advertisements", function (){ return view("website.static.advertisements" ); });
Route::get("/news", function (){ return view("website.static.news" ); });
Route::get("/events", function (){ return view("website.static.events" ); });
Route::get("/event/{slug}", "EventsController@show");
Route::post("/events/filter", "EventsController@filter");

Route::get('/{any}', "PageController@show")->where('any', '.*');