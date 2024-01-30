<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderListResource;
use App\Models\Customer;
use App\Models\Order;
use App\Traits\ReportTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use ReportTrait;

    public function orders()
    {
        $query = Order::query()
            ->select([DB::raw('CAST(created_at as DATE) AS day'), DB::raw('COUNT(id) AS count')])
            ->groupBy(DB::raw('CAST(created_at as DATE)'));

        return $this->dataForBarChart($query, 'Orders by day');

    }

    public function customers()
    {
        $query = Customer::query()
            ->select([DB::raw('CAST(created_at as DATE) AS day'), DB::raw('COUNT(user_id) AS count')])
            ->groupBy(DB::raw('CAST(created_at as DATE)'));

        return $this->dataForBarChart($query, 'Customers by day');
    }

    private function dataForBarChart($query, $label)
    {

        $fromDate = $this->getDatesFromParam() ?: Carbon::now()->subDays(30);

        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }
        $records = $query->get()->keyBy('day');

        $now = Carbon::now();
        $days = [];
        $labels = [];
        while ($fromDate < $now) {
            $key = $fromDate->format('Y-m-d');
            $labels[] = $key;
            $fromDate = $fromDate->addDay(1);
            $days[] = isset($records[$key]) ? $records[$key]['count'] : 0;
        }

        return [
            'labels' => $labels,
            'datasets' => [[
                'label' => $label,
                'backgroundColor' => '#f87979',
                'data' => $days
            ]]
        ];
    }
}
