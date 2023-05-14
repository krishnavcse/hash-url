<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UrlDetail;
use App\Models\User;

class HomeController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * method for dashboard view page
     * @return view
     */
    public function dashboard()
    {
    	$loggedInUser = Auth::user();
    	$urlCount = UrlDetail::count();
    	$all['active_url'] = UrlDetail::where('is_active', true)->count();
    	$all['deactive_url'] = UrlDetail::where('is_active', false)->count();
        
        return view('home', compact('urlCount', 'all'));
    }
}
