<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\FoodRequest;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->get();

        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_name' => 'required|string|max:255',
            'food_type' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'quantity_unit' => 'required|string|max:255',
            'description' => 'required|string',
            'pickup_location' => 'required|string|max:255',
            'available_until' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Image to Cloudinary
        |--------------------------------------------------------------------------
        */

       if ($request->hasFile('image')) {
    try {
        $uploadedFile = Cloudinary::upload(
            $request->file('image')->getRealPath(),
            [
                'folder' => 'donations',
            ]
        );

        $validated['image'] = $uploadedFile->getSecurePath();

    } catch (\Throwable $e) {
        \Log::error('CLOUDINARY UPLOAD ERROR', [
            'message' => $e->getMessage(),
        ]);

        return back()
            ->withInput()
            ->with('error', 'Image upload failed: ' . $e->getMessage());
    }
}

        /*
        |--------------------------------------------------------------------------
        | Save Donation
        |--------------------------------------------------------------------------
        */

        try {

            Donation::create($validated);

        } catch (\Throwable $e) {

            \Log::error('DONATION CREATE ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Donation could not be saved: ' . $e->getMessage());
        }

        return redirect()
            ->route('donations.index')
            ->with('success', 'Food donation added successfully!');
    }

    public function requestFood(Request $request, Donation $donation)
    {
        $validated = $request->validate([
            'requester_name' => 'required|string|max:255',
            'requester_email' => 'required|email|max:255',
            'requested_quantity' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        $validated['donation_id'] = $donation->id;

        try {

            FoodRequest::create($validated);

            $donation->update([
                'status' => 'requested',
            ]);

        } catch (\Throwable $e) {

            \Log::error('FOOD REQUEST ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Food request failed: ' . $e->getMessage());
        }

        return redirect()
            ->route('donations.index')
            ->with('success', 'Food request submitted successfully!');
    }
}