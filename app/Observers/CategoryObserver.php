<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Products\Config\Category;

class CategoryObserver
{
    /**
     * Handle the category "saving" event.
     *
     * @param  App\Models\Products\Config\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $category->slug = Str::slug($category->category, '-');
    }

    /**
     * Handle the category "deleting" event.
     *
     * @param  App\Models\Products\Config\Category  $category
     * @return void
     */
    public function deleting(Category $category)
    {
        $category->products()->delete();
    }
}
