<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    /**
     * Display a listing of petitions (Explore page).
     */
    public function index()
    {
        // Fetch petitions ordered by signature count, with pagination
        $petitions = Petition::orderByDesc('signature_count')->paginate(10);

        return view('petitions.index', compact('petitions'));
    }

    /**
     * Show the form for creating a new petition.
     */
    public function create()
    {
        return view('petitions.create');
    }

    /**
     * Store a newly created petition in storage.
     */
    public function store(Request $request)
    {
        // Validate petition input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target' => 'nullable|integer|min:0',
        ]);

        // Create petition with defaults for signatures and donations
        $petition = Petition::create(array_merge($validated, [
            'signature_count' => 0,
            'donation_total' => 0,
        ]));

        // Redirect to petition detail page with success message
        return redirect()->route('petitions.show', $petition)
                         ->with('success', 'Petition created successfully!');
    }

    /**
     * Display the specified petition with donations.
     */
    public function show(Petition $petition)
    {
        // Eager load donations with user relationship
        $petition->load(['donations.user']);

        return view('petitions.show', compact('petition'));
    }
}
