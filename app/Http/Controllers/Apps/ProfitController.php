<?php

namespace App\Http\Controllers\Apps;

use App\Exports\ProfitsExport;
use App\Http\Controllers\Controller;
use App\Models\Profit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ProfitController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware(['permission:profits.index'], only: ['index', 'filter']),
        ];
    }

    public function index()
    {
        return Inertia::render('Apps/Profits/Index');
    }

    public function filter(Request  $request)
    {
        $request->validate([
            'start_date'  => 'required',
            'end_date'    => 'required',
        ]);

        $profits = Profit::with('transaction')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        $total = Profit::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('total');

        return Inertia::render('Apps/Profits/Index', [
            'profits' => $profits,
            'total'   => (int)$total
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(new ProfitsExport($request->start_date, $request->end_date), 'profits : ' . $request->start_date . ' — ' . $request->end_date . '.xlsx');
    }
}
