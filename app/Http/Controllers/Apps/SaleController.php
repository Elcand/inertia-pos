<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

class SaleController extends Controller
{
    public static function middleware()
    {
        return [
            new Middleware(['permission:sales.index'], only: ['index', 'filter']),
        ];
    }

    public function index()
    {
        return Inertia::render('Apps/Sales/Index');
    }

    public function filter(Request $request)
    {
        $request->validate([
            'start_date'    => 'required',
            'end_date'      => 'required',
        ]);

        $sales = Transaction::with('cashier', 'customer')
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->get();

        $total = Transaction::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->sum('grand_total');

        return Inertia::render('Apps/Sales/Index', [
            'sales' => $sales,
            'total' => $total
        ]);
    }
}
