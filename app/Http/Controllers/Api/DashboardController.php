<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function ordersByCountry()
    {
        return Order::query()
            ->select('customer_addresses.country_code', DB::raw('count(order.id) as count'))
            ->join('users', 'created_by', '=', 'users.id')
            ->join('customer_addresses', 'users.id', '=', 'customer_addresses.customer_id')
            ->where('status', 'paid')
            ->groupBy('customer_addresses.country_code')
            ->get();
    }
}
