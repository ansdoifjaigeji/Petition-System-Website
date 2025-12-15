<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

        // Latest articles/posts (used on the home page)
        $posts = Post::orderByDesc('created_at')->take(3)->get(['id','title','content']);

        return view('pages.home', compact('trending_petitions', 'posts'));
    }

    /**
     * Show the about us page.
     */
    public function about()
    {
        return view('pages.about');
    }
}