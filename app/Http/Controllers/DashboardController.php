<?php

namespace MyNews\Http\Controllers;

use MyNews\Article;

use Illuminate\Support\Facades\Auth;

use MyNews\Http\Requests;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * Show the user articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$articles = Article::where('user_id', '=', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
    	return view('home', ['articles'=>$articles]);
    }
}
