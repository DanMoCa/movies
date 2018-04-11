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



Route::get('numbers',function(){
  $sum;

  for ($i=1; $i <= 1000; $i++) {
    if(($i % 3 == 0) && ($i % 5 == 0) && ($i % 7 == 0)){
      $sum =+ $i;
    }
  }

  echo $sum;
});

Route::get('/',['uses'=>'MovieController@getMovies'])->name('index');
Route::get('newmovie',['uses'=>'MovieController@getNewMovie','name'=>'newmovie'])->name('newmovie');
Route::post('createmovie',['uses'=>'MovieController@createMovie'])->name('createmovie');
Route::get('getmovie/{id}',['uses'=>'MovieController@getMovie'])->name('getmovie');
Route::post('editmovie',['uses'=>'MovieController@editMovie'])->name('editmovie');
Route::delete('deletemovie',['uses'=>'MovieController@deleteMovie'])->name('deletemovie');
