<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:customers.index'], only: ['index']),
            new Middleware(['permission:customers.create'], only: ['create', 'store']),
            new Middleware(['permission:customers.edit'], only: ['edit', 'update']),
            new Middleware(['permission:customers.delete'], only: ['destroy']),
        ];
    }

    public function index()
    {
        $customers = Customer::where(request()->q, function ($customers) {
            $customers = $customers->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        return Inertia::render('Apps/Customers/Index', [
            'customers' => $customers
        ]);
    }

    public function create()
    {
        return Inertia::render('Apps/Customers/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'no_telp'   => 'required|unique:customers',
            'address'   => 'required'
        ]);

        Customer::create([
            'name'      => $request->name,
            'no_telp'   => $request->no_telp,
            'address'   => $request->address
        ]);

        return redirect()->route('apps.customers.index');
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Apps/Customers/Edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'      => 'required',
            'no_telp'   => 'required|unique:customers,no_telp,' . $customer->id,
            'address'   => 'required',
        ]);

        $customer->update([
            'name'      => $request->name,
            'no_telp'   => $request->no_telp,
            'address'   => $request->address
        ]);

        return  redirect()->route('apps.customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('apps.customers.index');
    }
}
