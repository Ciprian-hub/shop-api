<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function activeCustomers ()
    {
        return Customer::all()->count();
    }

    public function activeProducts ()
    {
        return Product::all()->count();
    }

    public function paidOrders ()
    {
        return Order::where('status', 'paid')->count();
    }

    public function totalIncome ()
    {
        return Order::where('status', 'paid')->sum('total_price');
    }
}
