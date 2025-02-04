<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function createOrGetCategory($categoryTitle)
    {
        return Category::firstOrCreate(['title' => $categoryTitle]);
    }
}
