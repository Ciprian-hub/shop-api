<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var  $user */
        $user = $request->user();
        $orders = Order::where('created_by', $user->id)->get();

        return view('order.index', compact('orders'));
    }

    public function view()
    {

    }
}
