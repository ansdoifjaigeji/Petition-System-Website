<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petition;

class PetitionController extends Controller
{
    /**
     * Display a listing of all petitions.
     */
    public function index()
    {
        $petitions = Petition::all();
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target' => 'nullable|string|max:255',
        ]);

        // Add default values
        $validatedData['signature_count'] = 0;
        $validatedData['user_id'] = auth()->id();

        Petition::create($validatedData);

        return redirect()->route('petitions.index')
            ->with('success', 'Petition created successfully!');
    }

    /**
     * Show the form for editing the specified petition.
     */
    public function edit($id)
    {
        $petition = Petition::findOrFail($id);
        return view('petitions.edit', compact('petition'));
    }

    /**
     * Update the specified petition in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target' => 'nullable|string|max:255',
        ]);

        $petition = Petition::findOrFail($id);
        $petition->update($validatedData);

        return redirect()->route('petitions.index')
            ->with('success', 'Petition updated successfully!');
    }

    /**
     * Delete petition.
     */
    public function destroy($id)
    {
        Petition::findOrFail($id)->delete();

        return redirect()->route('petitions.index')
            ->with('success', 'Petition deleted successfully!');
    }
    /**
 * Display a single petition.
 */
public function show($id)
{
    $petition = Petition::findOrFail($id);
    return view('petitions.show', compact('petition'));
}

public function sign(Request $request, $id)
{
    // Validasi
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    // Save signature
    SignatureController::create([
        'petition_id' => $id,
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect()->back()->with('success', 'Thank you for signing!');
}

}
