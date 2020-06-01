<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products\Product;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Products\ProductCollection;

class TestController extends Controller
{
    public function index()
    {
        return ProductCollection::make( Product::paginate(10) );
    }

    public function create(Request $request)
    {
        return ProductResource::create( $request );
    }

    public function show(Product $product)
    {
        return ProductResource::make( $product );
    }
}
