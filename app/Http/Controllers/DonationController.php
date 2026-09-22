<?php

namespace App\Http\Controllers;
use App\Models\Donation;
use App\Models\FoodRequest;


use Illuminate\Http\Request;

class DonationController extends Controller
{
    //
    public function index()
    {
        $donations = Donation::where('available_until', '>', now())
        ->latest()
        ->get();

        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_name'=> 'required|string|max:255',
            'food_type'=>'required|string|max:100',
            'quantity'=>'required|integer|min:1',
            'quantity_unit'=>'required|string|max:255',
            'description'=>'required|string',
            'pickup_location'=>'required|string|max:255',
            'available_until'=>'required|date',
            'image'=>'nullable|image|max:2048',

        ]);

        if($request->hasFile('image')) {
            $validated['image']=
            $request->file('image')->store('donations','public');
        }

        Donation::create($validated);

        return redirect()
        ->route('donations.create')
        ->with('success', 'Food donation added successfully');
    }


    public function requestFood(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'requester_name' => 'required|string|max:255',
            'requester_email' => 'required|email|max:255',
            'requested_quantity' => 'required|integer|min:1',
            'message'=>'nullable|string',
        ]);

        $validated['donation_id']= $donation->id;

        FoodRequest::create($validated);

        $donation->update([
            'status'=>'requested',
        ]);

        return redirect()
        ->route('donations.index')
        ->with('success', 'Food request submitted successfully');
    }
}
