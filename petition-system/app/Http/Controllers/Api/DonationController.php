<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DonationController extends Controller
{
    /**
     * List donations for a petition (API).
     */
    public function index(Petition $petition)
    {
        $donations = $petition->donations()
            ->with(['user:id,name,email'])
            ->orderByDesc('created_at')
            ->get();

        return response()->json($donations);
    }

    /**
     * Create a donation for a petition (API).
     */
    public function store(Request $request, Petition $petition)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $donation = Donation::create([
            'user_id' => $request->user()->id,
            'petition_id' => $petition->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
        ]);

        if (Schema::hasColumn('petitions', 'donation_total')) {
            $petition->increment('donation_total', $request->amount);
        }

        return response()->json([
            'message' => 'Donation created successfully',
            'donation' => $donation,
            'donation_total' => $petition->donation_total,
        ], 201);
    }
}
