<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get("/checkDemografi", "CheckDemografiController@check");
Route::get('/', function () {
    $faker = Faker\Factory::create();
    
    $limit = 20;
    
    for($i=0; $i<$limit;$i++){
        echo $faker->password().' <br>';
        echo $faker->randomFloat(null, 0, 5);
        echo '<br>';
    }
    
    
});


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});


Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password Reset Routes...
Route::get('password/reset', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UsersController');

Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');

Route::resource('questions', 'QuestionsController');

Route::resource('userQuestions', 'UserQuestionsController');

Route::resource('categories', 'CategoriesController');

Route::get('/calculationAhp', 'CalculationAHPController@index');
Route::get('/calculationAhp/{type}', 'CalculationAHPController@subfactor');

Route::get('/calculationFuzzy', 'CalculationFuzzyController@index');
Route::get('/calculationFuzzy/{type}', 'CalculationFuzzyController@subfactor');

Route::resource('experts', 'ExpertsController');

Route::resource('expertsQuestions', 'ExpertsQuestionsController');

Route::resource('expertAnswers', 'ExpertAnswersController');

Route::resource('subCategories', 'SubCategoriesController');

Route::resource('dataDosens', 'DataDosenController');