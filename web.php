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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get("/","PageController@login")->name('login');
// Route::get("/user","PageController@userEditForm");
// Route::post("/update-user","PageController@updateUser");
// Route::get("/news","PageController@news");
// Route::get("/weatherforecast","PageController@weatherForecast")->middleware('auth');
// Route::get("/weatherforecast/add-form","PageController@addWeatherForecast");
// Route::post("/save","PageController@saveWeatherForecast");
// Route::get("/weatherforecast/edit-form/{id}","PageController@editWeatherForecast");
// Route::put("/update/{id}","PageController@updateWeatherForecast");
// Route::get("/delete/{id}","PageController@deleteWeatherForecast");

// // login and logout
// Route::post("/login","AuthController@loginCheck");
// Route::get("/logout", "AuthController@logoutCheck");


// Routes for guests
Route::group(['middleware' => ['guest']], function() {
    Route::post("/login", "AuthController@loginCheck");
    Route::get("/", "PageController@login")->name('login');
});

// Routes for authenticated users
Route::group(['middleware' => ['auth']], function() {
    Route::get("/logout", "AuthController@logoutCheck");
    Route::get("/user", "PageController@userEditForm");
    Route::post("/update-user", "PageController@updateUser");
    Route::get("/news", "PageController@news");
    Route::get("/weatherforecast", "PageController@weatherForecast");
    Route::get("/weatherforecast/add-form", "PageController@addWeatherForecast");
    Route::post("/save", "PageController@saveWeatherForecast");
    Route::get("/weatherforecast/edit-form/{id}", "PageController@editWeatherForecast");
    Route::put("/update/{id}", "PageController@updateWeatherForecast");
    Route::get("/delete/{id}", "PageController@deleteWeatherForecast");
});
