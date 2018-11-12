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

//Descarga de apk
Route::get('download/application', ['as' => 'download-apk', 'uses' => 'HomeController@download']);

/*
 * Authentication Routes
 */
Route::group([], function () {
    Route::auth();
    Route::post('auth/login', ['as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
    Route::get('logout', 'Auth\LoginController@logout');
});

//Home
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/table/{module}', ['as' => 'home', 'uses' => 'HomeController@manage']);

Route::group(['prefix' => 'home'], function () {
    Route::get('/', 'HomeController@index');
});

Route::get('/construction', 'HomeController@construction');

/*Profiles*/
Route::get('/user/profile/{id?}', ['as' => 'profile', 'uses' => 'UserController@showProfile']);
Route::post('/user/updateProfile', 'UserController@updateProfile');
Route::post('/user/updateProfilePicture', 'UserController@updateProfilePicture');
Route::post('/user/updateContact', 'UserController@updateContact');

/*Sectorizacion*/
Route::get('/user/sectors', ['as' => 'user.sector.index', 'uses' => 'UserSectorController@showUserSectors']);
Route::get('/user/sectors/edit/{id?}', ['as' => 'user.sector.edit', 'uses' => 'UserSectorController@editUserSector']);
Route::post('/user/sectors/edit/{id?}', ['as' => 'user.sector.update', 'uses' => 'UserSectorController@updateUserSector']);
Route::post('/user/sectors/remove/{id?}', ['as' => 'user.sector.remove', 'uses' => 'UserSectorController@removeUserSector']);

/*Store (Branchs)*/
Route::get('/store/store', 'StoreController@showStore');
Route::get('/store/storeDetails/{id}', 'StoreController@showStoreDetail');
Route::get('/store/storeEdit/{id?}', 'StoreController@showStoreEdit');
Route::get('/store/branch', 'StoreController@showBranches');
Route::get('/store/branchDetails/{id}', 'StoreController@showBranchDetail');
Route::get('/store/branchContactDetails/{id}', 'StoreController@showBranchContactDetail');
Route::get('/store/branchEdit/{id?}', 'StoreController@showBranchEdit');

Route::post('/store/storeEdit/{id?}', ['as' => 'store.edit' ,'uses' => 'StoreController@updateStore']);
Route::post('/store/removeStore/{id}', 'StoreController@removeStore');

/*category*/
Route::get('/store/category', 'CategoryController@showCategories');
Route::get('/store/categoryEdit/{id?}', 'CategoryController@showCategoryEdit');
Route::post('/store/categoryEdit/{id?}', 'CategoryController@updateCategory');

/*Maps*/
Route::get('/store/map', 'LocalizationController@showMap');
Route::get('/store/map/hours/{id}/{date}', 'LocalizationController@getHours');

/*Products*/
Route::get('/products/', 'ProductsController@showProducts');
Route::get('/products/m/{module?}', 'ProductsController@showProducts');
Route::get('/product/edit/{id?}', ['as' => 'product.edit' ,'uses' => 'ProductsController@showEditProduct']);
Route::get('/product/devices', ['as' => 'devices' ,'uses' => 'ProductsController@showDevices']);
Route::get('/product/device/edit/{id?}', ['as' => 'device.edit' ,'uses' => 'ProductsController@showEditDevice']);
Route::get('/product/{id}/show', ['as' => 'product.show' ,'uses' => 'ProductsController@show']);

Route::post('/product/edit/{id?}', 'ProductsController@updateProduct');
Route::post('/product/device/edit/{id?}', 'ProductsController@updateDevice');
Route::post('/product/remove/{id}', 'ProductsController@removeProduct');
Route::post('/product/device/remove/{id}', 'ProductsController@removeDevice');

/*Activities and evidences*/
Route::get('/activities', 'ActivitiesController@showActivities');
Route::get('/activities/edit/{id?}', 'ActivitiesController@showEditActivity');
Route::get('/getFeaturesByLog/{idlog}', 'ActivitiesController@showFeatures');
Route::get('/getBranchItemsByLog/{idlog}', ['as' => 'activity.show_items', 'uses' => 'ActivitiesController@showBranchItems']);
Route::get('/getPhotoByLog/{idlog}', 'ActivitiesController@showPhoto');
Route::get('/getEvidence/{idlog}', ['as' => 'activity.show_photo_evidences', 'uses' => 'ActivitiesController@showEvidence']);
Route::get('/downloadPhotoByEvidence/{id}', ['as' => 'activity.download_photo_evidence' ,'uses' => 'ActivitiesController@downloadPhotoByEvidence']);
Route::post('/activities/edit/{id?}', ['as' => 'activity.edit' ,'uses' => 'ActivitiesController@updateActivity']);

//Search ajax
Route::get('/search/states/{country_id?}', ['as' => 'search.states_by_country' ,'uses' => 'StateController@statesByCountry']);
Route::get('/search/cities/{state_id?}', ['as' => 'search.cities_by_state' ,'uses' => 'CityController@citiesByState']);
Route::get('/search/townships/{city_id?}', ['as' => 'search.townships_by_city' ,'uses' => 'TownshipController@townshipsByState']);
Route::get('/search/category/{id?}', ['as' => 'search.categories.data' ,'uses' => 'CategoryController@categoryData']);
Route::get('/search/product/{id?}', ['as' => 'search.products.data' ,'uses' => 'ProductsController@search']);

/*Request Android*/
Route::post('android/login', 'AndroidRequestsController@androidLogin');
Route::post('android/systemCache', 'AndroidRequestsController@systemCache');
Route::post('android/forgetPassword', 'AndroidRequestsController@forgetPassword');
Route::post('android/resetPassword', 'AndroidRequestsController@resetPassword');
Route::post('android/synchronizeServer', 'AndroidRequestsController@synchronizeServer');
Route::post('android/synchronizeLocalization', 'AndroidRequestsController@syncGeolocalization');
Route::post('android/synchronizeData', 'AndroidRequestsController@synchronizeData');

