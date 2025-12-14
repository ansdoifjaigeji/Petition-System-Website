<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Petition; // Import the Petition model

class PageController extends Controller
{
    /**
     * Show the home page with trending petitions.
     */
    public function home()
    {
        $posts = Post::latest()->take(6)->get();

        $trending_petitions = Petition::orderByDesc('signature_count')
                                      ->take(3)
                                      ->get();

        return view('pages.home', compact('posts', 'trending_petitions'));
    }

    /**
     * Show the about us page.
     */
    public function about()
    {
        return view('pages.about');
    }
}