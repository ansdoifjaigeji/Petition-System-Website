<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petition; // Import the Petition model

class PageController extends Controller
{
    /**
     * Show the home page with trending petitions.
     */
    public function home()
    {
        // This is your database query from Index.php, written in Eloquent
        $trending_petitions = Petition::orderByDesc('signature_count')
                                      ->take(3)
                                      ->get();
        
        // Return the view and pass the data to it
        return view('pages.home', [
            'trending_petitions' => $trending_petitions
        ]);
    }

    /**
     * Show the about us page.
     */
    public function about()
    {
        return view('pages.about');
    }
}