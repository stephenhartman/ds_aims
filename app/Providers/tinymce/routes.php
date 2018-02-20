<?php

Route::post('/tinymce/simple-image-upload', 'App\Http\Controllers\TinymceController@uploadImage')->name('tinymce.imageupload');