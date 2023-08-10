<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    function getMainCategory()
    {
        return Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
    }

    function getStoreCategory($request)
    {
    }
}
