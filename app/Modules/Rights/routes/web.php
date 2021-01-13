<?php




Route::group(['module' => 'Rights', 'middleware' => ['web','auth']], function() {

    Route::get('rights/manage-users', 'RightsController@manageUsers');
    Route::get('rights/get-users-list', 'RightsController@getUsersList');

    Route::get('rights/roles/list', 'RolesController@index');
    Route::get('rights/roles/get-list', 'RolesController@getList');
    Route::get('rights/roles/add', 'RolesController@add');
    Route::post('rights/roles/save', 'RolesController@save');
    Route::get('rights/roles/assign-role/{id}', 'RolesController@assignRole');
    Route::post('rights/roles/save-role/{id}', 'RolesController@saveRole');



    Route::get('rights', 'PermissionsController@welcome');
    Route::get('rights/permissions/list', 'PermissionsController@index');
    Route::get('rights/permissions/get-list', 'PermissionsController@getList');
    Route::get('rights/permissions/add', 'PermissionsController@add');
    Route::post('rights/permissions/save', 'PermissionsController@save');
});
