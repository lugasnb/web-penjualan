<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;


class PageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() 
    { 
        $totalCustomers = Customer::count(); 
        $totalProducts = Product::count(); 
        $totalTransactions = Transaction::count();
         
 
        return view('dashboard.index', compact( 
            'totalCustomers', 
            'totalProducts', 
            'totalTransactions'
        )); 
    }
}
