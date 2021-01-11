<?php

Route::get('rights', 'RightsController@welcome');
Route::get('rights/roles/list', 'RolesController@index');
Route::get('rights/roles/get-list', 'RolesController@getList');
Route::get('rights/roles/add', 'RolesController@addRole');
