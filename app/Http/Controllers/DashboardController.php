<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\FoodRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDonations = Donation::count();

        $totalRequests = FoodRequest::count();

        $pendingRequests = FoodRequest::where('status', 'pending')->count();

        $approvedRequests = FoodRequest::where('status', 'approved')->count();

        $rejectedRequests = FoodRequest::where('status', 'rejected')->count();

        return view('dashboard', compact(
            'totalDonations',
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests'
        ));
    }
}