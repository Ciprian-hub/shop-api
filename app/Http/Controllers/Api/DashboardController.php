<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\OrderResource;
use App\Models\Api\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Traits\ReportTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class DashboardController extends Controller
{
    use ReportTrait;

    public function activeCustomers()
    {
        return Customer::all()->count();
    }

    public function activeProducts()
    {
        return Product::where('published', '=', 1)->count();
    }

    public function paidOrders()
    {
        $fromDate = $this->getDatesFromParam();
        $query = Order::query('status', 'paid');

        if($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }

        return $query->count();
    }

    public function totalIncome()
    {
        $fromDate = $this->getDatesFromParam();
        $query =  Order::where('status', 'paid');

        if($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }

        return round($query->sum('total_price'));
    }

    public function ordersByCountry()
    {
        $fromDate = $this->getDatesFromParam();
        $query = Order::query()
            ->select(['c.name', DB::raw('count(order.id) as count')])
            ->join('users', 'created_by', '=', 'users.id')
            ->join('customer_addresses AS a', 'users.id', '=', 'a.customer_id')
            ->join('countries AS c', 'a.country_code', '=', 'c.code')
            ->where('status', 'paid')
            ->groupBy('c.name');

        if($fromDate) {
            $query->where('order.created_at', '>', $fromDate);
        }

        return $query->get();
    }

    public function latestCustomers(): string
    {
        return Customer::query()
            ->select(['first_name', 'last_name', 'u.email', 'phone', 'u.created_at'])
            ->join('users As u', 'u.id', '=', 'customers.user_id')
            ->limit(4)->get();
    }

    public function latestOrders(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return OrderResource::collection(
            Order::query()
                ->select(['o.id', 'o.total_price', 'o.created_at', DB::raw('COUNT(oi.id) AS items'), 'c.user_id', 'c.first_name', 'c.last_name'])
                ->from('order AS o')
                ->join('order_items AS oi', 'oi.order_id', '=', 'o.id')
                ->join('customers AS c', 'c.user_id', '=', 'o.created_by')
                ->where('o.status', OrderStatus::Paid->value)
                ->limit(5)
                ->orderBy('o.created_at', 'desc')
                ->groupBy('o.id')
                ->get()
        );
    }
}
