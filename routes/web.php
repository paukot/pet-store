<?php

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::all();
    $tags = Tag::all();

    return view('welcome', compact('categories', 'tags'));
});
