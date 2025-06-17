<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware(['permission:products.index'], only: ['index']),
            new Middleware(['permission:products.create'], only: ['create', 'store']),
            new Middleware(['permission:products.edit'], only: ['edit', 'update']),
            new Middleware(['permission:products.delete'], only: ['destroy']),
        ];
    }

    public function index()
    {
        $products = Product::when(request()->q, function ($products) {
            $products = $products->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(10);

        return  Inertia::render('Apps/Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Apps/Products/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'required|mimes:jpg,jpeg,png|max:2000',
            'barcode'       => 'required|unique:products',
            'title'         => 'required',
            'description'   => 'required',
            'categories_id' => 'required',
            'buy_price'     => 'required',
            'sell_price'    => 'required',
            'stock'         => 'required'
        ]);

        $image = $request->file('image');
        $image->storeAs('products', $image->hashName(), 'public');

        Product::create([
            'image' => $request->hashName(),
            'barcode' => $request->barcode,
            'title' => $request->title,
            'description' => $request->description,
            'category_id'   => $request->category_id,
            'buy_price'     => $request->buy_price,
            'sell_price'    => $request->sell_price,
            'stock'         => $request->stock,
        ]);

        return redirect()->route('apps.products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return Inertia::render('Apps/Products/Edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'barcode'       => 'required|unique:products,barcode,' . $product->id,
            'title'         => 'required',
            'description'   => 'required',
            'categories_id' => 'required',
            'buy_price'     => 'required',
            'sell_price'    => 'required',
            'stock'         => 'required'
        ]);

        if ($request->file('image')) {
            Storage::disk('public')->delete('products/' . basename($product->image));

            $image = $request->file('image');
            $image->storeAs('products', $image->hashName(), 'public');

            $product->update([
                'barcode'       => $request->barcode,
                'title'         => $request->title,
                'description'   => $request->description,
                'category_id'   => $request->category_id,
                'buy_price'     => $request->buy_price,
                'sell_price'    => $request->sell_price,
                'stock'         => $request->stock,
            ]);
        }
        return redirect()->route('apps.products.index');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete('products/'.basename($product->image));
        $product->delete();

        return redirect()->route('apps.products.index');
    }
}
