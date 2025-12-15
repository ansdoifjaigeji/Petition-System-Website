<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petition;

class PageController extends Controller
{
    /**
     * Show the home page with trending petitions.
     */
    public function home()
    {
        // Fetch top 3 petitions by signatures (and donations as secondary sort)
        $trending_petitions = Petition::orderByDesc('signature_count')
                                      ->orderByDesc('donation_total')
                                      ->take(3)
                                      ->get(['id','title','description','signature_count','donation_total']);

        return view('pages.home', compact('trending_petitions'));
    }

    /**
     * Show the about us page.
     */
    public function about()
    {
        return view('pages.about');
    }
}