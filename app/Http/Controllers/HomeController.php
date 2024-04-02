<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalcustomers=Customer::all()->count();
        $totalrestaurants=Restaurant::all()->count();
        $totalusers=User::all()->count();
        $totalriders=Rider::all()->count();

        // Fetch count of customers, restaurants, and riders for each month
        $customerData = DB::table('customers')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $restaurantData = DB::table('restaurants')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $riderData = DB::table('riders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

         // If there is no data for a month, add it with count 0
         $months = range(1, 12);
         $customerCounts = $customerData->pluck('count', 'month')->toArray();
         $restaurantCounts = $restaurantData->pluck('count', 'month')->toArray();
         $riderCounts = $riderData->pluck('count', 'month')->toArray();
 
         $customerMonthlyData = array_map(function ($month) use ($customerCounts) {
             return $customerCounts[$month] ?? 0;
         }, $months);
 
         $restaurantMonthlyData = array_map(function ($month) use ($restaurantCounts) {
             return $restaurantCounts[$month] ?? 0;
         }, $months);
 
         $riderMonthlyData = array_map(function ($month) use ($riderCounts) {
             return $riderCounts[$month] ?? 0;
         }, $months);

        return view('home',
        compact('totalcustomers', 'totalrestaurants', 'totalusers', 'totalusers', 'totalriders', 'customerMonthlyData', 'restaurantMonthlyData', 'riderMonthlyData'));
    }
}
