<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/web/product.php';
require __DIR__ . '/web/category.php';
