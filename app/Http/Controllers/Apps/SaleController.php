<?php

namespace App\Http\Controllers\Apps;

use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export(Request $request)
    {
        return Excel::download(new SalesExport($request->start_date, $request->end_date), 'sales : ' . $request->start_date . ' - ' . $request->end_date . '.xlsx');
    }

    public function pdf(Request $request)
    {
        $sales = Transaction::with('cashier', 'customer')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        $total = Transaction::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('grand_total');

        $pdf = PDF::loadView('exports.sales', compact('sales', 'total'));

        return $pdf->download('sales : ' . $request->start_date . ' — ' . $request->end_date . '.pdf');
    }
}
