<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DonationWebController extends Controller
{
    /**
     * Show donation form for a petition (Blade UI).
     */
    public function create(Petition $petition)
    {
        return view('donations.create', compact('petition'));
    }

    /**
     * Handle donation submission (Blade UI).
     */
    public function store(Request $request, Petition $petition)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'nullable|string|max:50',
        ]);

        Donation::create([
            'user_id' => auth()->id(),
            'petition_id' => $petition->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'] ?? null,
        ]);

        if (Schema::hasColumn('petitions', 'donation_total')) {
            $petition->increment('donation_total', $validated['amount']);
        }

        return redirect()->route('petitions.show', $petition->id)
                         ->with('success', 'Thank you for your donation!');
    }
}
