<?php namespace App\Http\Controllers;

use Auth;

	
class HomeController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/
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
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->role == "volunteer")
				return view('dashboard.volunteer', compact('user', $user));

			else if ($user->role == "group")
				return view('dashboard.group', compact('user', $user));

			else if ($user->role == "organization")
				return view('dashboard.organization', compact('user', $user));
		}
		
		
		return view('home');
	}

	public function getSettings() {

		return "Settings";
	}
}