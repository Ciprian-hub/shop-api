<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderListResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public static bool $wrap =false;

    public function index ()
    {
        $search = request('search', false);
        $perPage = request('per_page', 10);
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = \App\Models\Customer::query();
        $query->orderBy($sortField, $sortDirection);
        if($search){
            $query->where('id', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }
        return CustomerResource::collection($query->paginate($perPage));
    }

    public function show (Request $request, Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function update(CustomerRequest $request, Customer $customer): CustomerResource
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $customer->update($data);

        return new CustomerResource($customer);
    }

}
