<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Category;


class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return $category;
    }

}
