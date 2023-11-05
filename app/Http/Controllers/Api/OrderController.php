<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderListResource;
use App\Models\Api\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
        return OrderListResource::collection($query->paginate($perPage));
    }

    public function view (Order $order)
    {
        return $order;
    }
}
