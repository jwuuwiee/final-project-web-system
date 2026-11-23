<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'productCount' => Product::count(),
            'customerCount' => Customer::count(),
            'saleCount' => Sale::count(),
            'staffCount' => User::count(),
        ]);
    }
}