<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionApiController extends Controller
{
    /**
     * Get a list of all petitions (JSON)
     */
    public function index()
    {
        $petitions = Petition::all();
        
        return response()->json([
            'status' => 'success',
            'count' => $petitions->count(),
            'data' => $petitions
        ], 200);
    }

    /**
     * Get a single petition by ID (JSON)
     */
    public function show($id)
    {
        $petition = Petition::find($id);

        if (!$petition) {
            return response()->json([
                'status' => 'error',
                'message' => 'Petition not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $petition
        ], 200);
    }
}