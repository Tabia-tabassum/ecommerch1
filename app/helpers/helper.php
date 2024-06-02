<?php

use App\Models\Category;

function getCategory(){
    $category = Category::all();
    return isset($category) && !empty($category) ? $category : [];
}
