<?php

Route::resource('tasks', 'TaskController', [
	'except' => ['create', 'edit' ,'show']
]);

Route::get('/tasks/pagination', 'TaskController@pagination');