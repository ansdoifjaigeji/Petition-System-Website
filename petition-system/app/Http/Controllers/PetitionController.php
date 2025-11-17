<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petition;

class PetitionController extends Controller
{
    /**
     * Display a listing of all petitions (Explore page).
     */
    public function store(Request $request)
    {
        // 2. Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target' => 'nullable|string|max:255',
        ]);
    }
    public function index()
    {
        // Later, you'll fetch all petitions here
        // $petitions = Petition::all();
        // return view('petitions.index', ['petitions' => $petitions]);

        return view('petitions.index');
    }

    /**
     * Show the form for creating a new petition (Start a Petition page).
     */
    public function create()
    {
        return view('petitions.create');
    }
}