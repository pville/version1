<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Event;

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
       // $this->middleware('auth');
    }
    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $minutes = Carbon::now()->addMinutes(60);


        // use a cache to reduce mysql queries
       /* $Events = Cache::remember('Events', $minutes, function()
        {
            return DB::table('event')->take(10)->get();
        });*/
        $Events = Event::Where('status','=',0)->take(3)->get();


        if(Auth::check()) {

            $user = Auth::user();
            $data = array('user' => $user,'events' => $Events);

            return view('home')->with($data);
        }
        $data = array('events' => $Events);
        return view('home')->with($data);
    }

    public function getSettings() {

        return "Settings";
    }
}