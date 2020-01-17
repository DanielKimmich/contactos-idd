<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
//World
    Route::crud('worldcontinent', 'WorldContinentCrudController');
    Route::crud('worldcountry', 'WorldCountryCrudController');
    Route::crud('worlddivision', 'WorldDivisionCrudController');
    Route::crud('worldcity', 'WorldCityCrudController');

    Route::crud('migration', 'MigrationCrudController');

    Route::get('searchdivision', 'Api\WorldSearchController@searchdivision');
    Route::get('filterdivision', 'Api\WorldSearchController@filterdivision');
    
    Route::get('prueba', 'Api\WorldSearchController@prueba');
  //  Route::get('admin/api/division/{id}', '\Api\DivisionController@show');
}); // this should be the absolute last line of this file