<?php

namespace App\Http\Controllers;
use App\Models\FoodRequest;

use Illuminate\Http\Request;

class FoodRequestController extends Controller
{
    //
    public function index()
    {
        $request = FoodRequest::with('donation')
        ->latest()
        ->get();
        return view('food_requests.index', compact('request'));
    }

    public function approve(FoodRequest $foodRequest)
    {
        $foodRequest->update([
            'status'=>'approved',
        ]);

        return redirect()
        ->route('food_requests.index')
        ->with('success','Food request approved successfully');
    }

    public function reject(FoodRequest $foodRequest)
    {
        $foodRequest->update([
            'status'=>'rejected',
        ]);

        return redirect()
        ->route('food_requests.index')
        ->with('success','Food request rejected.');
    }
}
