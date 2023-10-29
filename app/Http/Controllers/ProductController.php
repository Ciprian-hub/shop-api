<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {

        $products = Product::query()->orderBy('updated_at', 'desc')->paginate(5);

        return view('product.index', [
            'products' => $products
        ]);
    }

    public function show(Product $product, Request $request)
    {
        $cartItems = Cart::getCartItems();
        return view('product.view', [
            'product' => $product,
            'foo' => $cartItems
//            'request' => \request(),
//            'user' => $request->user(),
//            'cookie' => $request->cookie()
        ]);
    }
}
