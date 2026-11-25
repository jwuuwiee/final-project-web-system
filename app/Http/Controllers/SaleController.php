<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['product', 'customer', 'staff'])
            ->latest()
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();

        $customers = Customer::orderBy('full_name')->get();

        // Temporary staff selection until Member 3 finishes authentication.
        $staff = User::orderBy('full_name')->get();

        return view('sales.create', compact('products', 'customers', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'customer_id' => ['nullable', 'exists:customers,id'],
            'sold_by' => ['required', 'exists:users,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::whereKey($validated['product_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($validated['quantity'] > $product->stock_quantity) {
                abort(
                    redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'quantity' => 'Insufficient stock. Available stock: '
                                . $product->stock_quantity,
                        ])
                );
            }

            $totalPrice = $product->price * $validated['quantity'];

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $validated['customer_id'] ?? null,
                'sold_by' => $validated['sold_by'],
                'quantity' => $validated['quantity'],
                'total_price' => $totalPrice,
            ]);

            $product->decrement(
                'stock_quantity',
                $validated['quantity']
            );
        });

        return redirect()
            ->route('sales.index')
            ->with('success', 'Sale recorded successfully.');
    }

    public function show(Sale $sale)
    {
        $sale->load(['product', 'customer', 'staff']);

        return view('sales.show', compact('sale'));
    }
}