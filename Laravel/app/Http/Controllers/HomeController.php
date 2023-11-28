<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // 追記@iwata
use Illuminate\Support\Facades\Auth; // 追記@iwata

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
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		return view('home');
	}
}
