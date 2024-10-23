<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardPage()
    {
        return view('dashboard_new');
    }

    public function summary(Request $request)
    {
        $userId = $request->header('User-Id');
    
        // Fetch counts of products and dealers
        $productCount = Product::where('user_id', $userId)->count();
        $dealerCount = Dealer::where('user_id', $userId)->count();
    
        return response()->json([
            'product' => $productCount,
            'dealer' => $dealerCount,
        ]);
    }


}
