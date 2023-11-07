<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderListResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public static $wrap =false;
    public function index ()
    {
        $search = request('search', false);
        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = \App\Models\Order::query();
        $query->orderBy($sortField, $sortDirection);
        if($search){
            $query->where('id', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }
        return OrderResource::collection($query->paginate($perPage));
    }

    public function view (Request $request, Order $order)
    {
        return new OrderResource($order);
    }
}
