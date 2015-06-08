<?php namespace App\Http\Controllers;

use Auth;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Validator;
use App\Organization;
use App\Attendance;
use App\Volunteer;
use App\Invite;
use Redirect;
use Illuminate\Support\Facades\DB;

class InviteController extends Controller {

    protected $redirectPath = "/events/create";

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getInvite($InviteCode) {

        $invite = Invite::Where('invite_code', '=', $InviteCode)->get();

        if(!$invite->isEmpty())
        {
            $invite = $invite[0];
            $minutes = $invite->created_at->diffInMinutes(Carbon::now());

            if( $minutes >= 5) {
                $invite->delete();
                dd("Invite code is no longer valid");
            }
            return view("register.invite");
        }

        return redirect(url("/"));

    }
}