<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $games = Game::all();
        $developers = Developer::all();
        return view('home', compact('games', 'developers'));
    }
}
