<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Products\Product;

class ProductObserver
{
    /**
     * Handle the product "saving" event.
     *
     * @param  App\Models\Products\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->slug = Str::slug($product->product, '-');
    }

    /**
     * Handle the product "deleting" event.
     *
     * @param  App\Models\Products\Product  $product
     * @return void
     */
    public function deleting(Category $product)
    {
        $product->products()->delete();
    }
}
