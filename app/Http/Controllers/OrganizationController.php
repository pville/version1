<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Volunteer;
use App\Group;
use App\Organization;
use App\Invite;
use Redirect;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Hash;
use Carbon\Carbon;
use Toast;
use App\Event;

class OrganizationController extends Controller {

    public function __construct()
    {
       // $this->middleware('auth');
    }





    public function getProfile($OrganizationSlug) {


        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $UpcomingEvents =  Event::Where('organization_id', '=', $org->id)
                ->where('status', '=', 'pending')
                ->orWhere('status', '=', 'started')
                ->orderBy('start_time','desc')
                ->get();

            $CompletedEvents = Event::Where('organization_id', '=', $org->id)
                ->where('status', '=', 'completed')
                ->orderBy('start_time','desc')
                ->get();



            return view('profile')
                ->with(compact('org', $org))
                ->with(compact('UpcomingEvents', $UpcomingEvents))
                ->with(compact('CompletedEvents', $CompletedEvents));
        }

        return redirect(url('/'));

    }



}

?>