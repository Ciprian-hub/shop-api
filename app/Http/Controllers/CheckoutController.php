<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $YOUR_DOMAIN = 'http://localhost:8000';
        \Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));

        list($products, $cartItems) = Cart::getCartProducts();

        $lineItems = [];

        foreach ($products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->title
                    ],
                    'unit_amount' => $product->price * 100
                ],
                'quantity' => $cartItems[$product->id]['quantity']
            ];
        }

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success',
            'cancel_url' => $YOUR_DOMAIN . '/cancel',
        ]);

        return redirect($checkout_session->url);

    }

    public function success(Request $request)
    {

    }

    public function failure(Request $request)
    {

    }
}
