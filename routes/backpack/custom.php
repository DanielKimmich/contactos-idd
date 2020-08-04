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

//Contact
    Route::crud('contactperson', 'ContactPersonCrudController');
    Route::crud('contactfamily', 'ContactFamilyCrudController');
    Route::crud('contactdata', 'ContactDataCrudController');
    Route::crud('contenttype', 'ContentTypeCrudController');    
    Route::get('contactdata/import', 'ContactDataCrudController@import');

//Blog 
    Route::crud('blogpost', 'BlogPostCrudController');
    Route::crud('blogcategory', 'BlogCategoryCrudController');
    Route::crud('blogtag', 'BlogTagCrudController');
    Route::crud('blogcomment', 'BlogCommentCrudController');

//World
    Route::crud('worldcontinent', 'WorldContinentCrudController');
    Route::crud('worldcountry', 'WorldCountryCrudController');
    Route::crud('worlddivision', 'WorldDivisionCrudController');
    Route::crud('worldcity', 'WorldCityCrudController');

//Authentication
    Route::crud('permission', 'PermissionCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('user', 'UserCrudController');    

//Report
    Route::crud('authchecker', 'AuthCheckerCrudController');
    Route::crud('migration', 'MigrationCrudController');


    Route::get('searchdivision/{id}', 'Api\WorldSearchController@searchdivision');
 //   Route::get('searchcity', 'Api\WorldSearchController@searchcity');
    Route::get('searchcity/{id}', 'Api\WorldSearchController@searchcity');
    
    Route::get('filterdivision', 'Api\WorldSearchController@filterdivision');
    
    Route::get('prueba', 'Api\WorldSearchController@prueba');
    Route::get('show', 'Api\WorldSearchController@show');
  //  Route::get('admin/api/division/{id}', '\Api\DivisionController@show');


    Route::crud('notification', 'NotificationCrudController');
//Backup
    Route::get('backup', 'BackupController@index')->name('backup.index');
    Route::put('backup/create', 'BackupController@create')->name('backup.store');
    Route::get('backup/download/{file_name?}', 'BackupController@download')->name('backup.download');
    Route::delete('backup/delete/{file_name?}', 'BackupController@delete')->where('file_name', '(.*)')->name('backup.destroy');


    Route::get('sendmail', 'Api\EmailNotificationController@sendMail');
}); // this should be the absolute last line of this file