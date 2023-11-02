<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        /** @var  $user */
        $user = $request->user();
        $orders = Orders::where('id', $user->id)->get();

        return view('order.index', compact('orders'));
    }

    public function view()
    {

    }
}
