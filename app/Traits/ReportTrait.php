<?php

namespace App\Traits;

use Carbon\Carbon;

trait ReportTrait
{
    private function getDatesFromParam()
    {
        $request = \request();
        $paramDate = $request->get('date');
        $array = [
            '2d' => Carbon::now()->subDays(1),
            '1wk' => Carbon::now()->subDays(7),
            '2wk' => Carbon::now()->subDays(14),
            '1m' => Carbon::now()->subDays(30),
            '3m' => Carbon::now()->subDays(90),
            '6m' => Carbon::now()->subDays(180),
//            'all'=> Carbon::now()->subDays(1),
        ];

        return $array[$paramDate] ?? null;
    }
}
