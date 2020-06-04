<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products\Product;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Products\ProductCollection;
use App\Http\Resources\Products\BestSellerCollection;

class TestController extends Controller
{
    public function index()
    {
        return ProductCollection::make( Product::paginate(10) );
    }

    public function create(Request $request)
    {
        return ProductResource::create( $request->all() );
    }

    public function show(Product $product)
    {
        return ProductResource::make( $product );
    }

    public function bestSeller()
    {
        $products = Product::withCount(['billingDetails as most_selled'])
            ->orderBy('most_selled', 'desc')
            ->limit(20)
            ->get();

        return BestSellerCollection::make( $products );
    }
}
