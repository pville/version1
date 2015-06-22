<?php namespace App\Http\Controllers;

use Auth;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Validator;
use App\Organization;
use App\Attendance;
use App\Notification;
use App\Volunteer;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use GeoIP;
use Toast;

class EventController extends Controller {

    protected $redirectPath = "/events/create";

    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function getCreateEvent(){

        if(Auth::check())
        {

            $minutes = Carbon::now()->addMinutes(1);



            $EventTypes = Cache::remember('event_category', $minutes, function()
            {
                return DB::table('event_category')->select('id', 'type')->get();
                //return DB::table('groups')->select('id', 'name')->get()->skip(1);
            });

            return view("events.create")->with(compact("EventTypes",$EventTypes));
        }
    }

    public function getEvents() {

        $Events = null;

        $Events = $this->getRuleFilter($Events);

        $Events = $Events->paginate(6);

        $Events->setPath('/events');

        $location = GeoIP::getLocation();

        $minutes = Carbon::now()->addMinutes(1);




        $EventTypes = Cache::remember('event_category', $minutes, function()
        {
            return DB::table('event_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

        $OrgTypes = Cache::remember('organization_category', $minutes, function()
        {
            return DB::table('organization_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });




        return view("events.grid")->with(compact('Events', $Events))->with(compact("EventTypes", $EventTypes))->with(compact("OrgTypes",$OrgTypes))->with(compact('location', $location));
    }

    public function postFilterEvents(Request $request) {

        $data = $request->all();

        $Events = null;

        $credits = intval($data["credits"]);
        $event = intval($data["event"]);
        $org = intval($data["org"]);



        if( $credits > 0 )
        {
            $Events = Event::Where("credits", "=", $credits);

        }

        if( $event > 0 ) {

            if (is_null($Events))
            {
                $Events = Event::Where("category", "=", $event);
            }
            else{

                $Events->where("category", "=", $event);
            }

        }

        if( $org > 0 ) {

            if (is_null($Events))
            {
                $Events = Event::Where("org_category", "=", $org);
            }
            else{

                $Events->where("org_category", "=", $org);
            }

        }

        $this->getRuleFilter($Events);

        if (is_null($Events))
            $Events = Event::paginate(6);
        else
            $Events = $Events->paginate(6);


        //$Events->setPath('/events');

        $location = GeoIP::getLocation();

        $minutes = Carbon::now()->addMinutes(1);



        $EventTypes = Cache::remember('event_category', $minutes, function()
        {
            return DB::table('event_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

        $OrgTypes = Cache::remember('organization_category', $minutes, function()
        {
            return DB::table('organization_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

        return view("events.grid")->with(compact('Events', $Events))->with(compact("EventTypes", $EventTypes))->with(compact("OrgTypes",$OrgTypes))->with(compact('location', $location));
    }

    public function getRuleFilter($Query) {

        if(Auth::check()) {
            $user = Auth::user();

            if($user->IsMember()) {

                $org_rules = json_decode($user->group->org_rules);

                foreach($org_rules as $rule) {
                   if(is_null($Query)) {
                       $Query = Event::Where('org_category', '!=', $rule);
                   }
                   else
                        $Query->where('org_category', '!=', $rule);
                }

                $event_rules = json_decode($user->group->event_rules);

                foreach($event_rules as $rule)
                    $Query->where('category', '!=', $rule);


                return $Query;
            }

        }
        $Query = Event::paginate(6);


        return $Query;

    }
    public function getRoster($OrganizationSlug, $EventSlug) {



        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);



            if(!is_null($event)){



                if(Auth::check()) {
                    $user = Auth::user();


                    if($user->role == "organization" && $user->organization->id == $org->id)
                    {

                        $Users = Attendance::Where('event_id', '=', $event->id)->where('checked_in', '=', false)->paginate(15);

                        
                        return view("events.roster")->with(compact("Users", $Users));
                    }

                }
            }
        }

        return redirect($this->redirectPath);

    }

    public function getComplete($OrganizationSlug, $EventSlug) {



        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);



            if(!is_null($event)){



                if(Auth::check()) {
                    $user = Auth::user();


                    if($user->role == "organization" && $user->organization->id == $org->id)
                    {
                         $event->status = 'processing';
                         $event->save();

                        Toast::success('Event has been marked as completed!', 'Success!');

                        return redirect(url("/dashboard"));
                    }

                }
            }
        }

        return redirect($this->redirectPath);

    }

    public function getEvent($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);
            $upcoming  =  Event::Where('organization_id', '=', $org->id)->orderBy('start_time')->take(4)->get();

            if(!is_null($event)){

                if(Auth::check()) {
                    $user = Auth::user();
                    return view('events.view')->with(compact('user', $user))->with(compact('event', $event))->with(compact('upcoming',$upcoming));

                }

                return view('events.view', compact('event', $event))->with(compact('upcoming',$upcoming));
            }
        }
        return redirect($this->redirectPath);
    }

    public function postCheckIn($OrganizationSlug, $EventSlug, Request $request) {

        if(Auth::check()) {
            $user = Auth::user();
            $data = $request->all();
            if ($user->role == "organization") {
                $checked = Attendance::where('user_id', '=', $data["user_id"])->where('event_id', '=', $data["event_id"])->take(1)->get();
                if(!$checked->isEmpty()) {
                    $checked = $checked[0];
                    $checked->checked_in = true;
                    $checked->save();
                    Toast::success('User has been checked in', 'Success!');

                    return redirect(url($request->url()));
                }
            }
        }

        return redirect(url("/"));
    }

    public function postJoinEvent($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);
            $upcoming  =  Event::Where('organization_id', '=', $org->id)->orderBy('start_time')->take(4)->get();

            if(!is_null($event)){

                if(Auth::check())
                {
                    $user =  Auth::user();

                    if($user->role == "volunteer")
                    {
                        // time to process the join.
                        $checked = Attendance::where('user_id', '=', $user->id)->where('event_id', '=', $event->id)->get();


                        if($checked->isEmpty()){
                            $join = new Attendance( array('event_id' => $event->id, 'user_id' => $user->id, "checked_in" => false));
                            $join->save();



                        }



                    }

                    return view('events.view')->with(compact('user', $user))->with(compact('event', $event))->with(compact('upcoming',$upcoming));
                }
                return view('events.view', compact('event', $event))->with(compact('upcoming',$upcoming));
            }
        }



        return Redirect::to('/login ');
    }

    public function postCreateEvent(Request $request) {

        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

       return $this->create($request);

        //return redirect($this->redirectPath);
    }


    public function validator(array $data) {

        return Validator::make($data, [
            'image' => 'required|image|mimes:jpeg,png',
            'title' => 'required|max:255',
            'desc' => 'required|max:1000',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'start' => 'required|date_format:m/d/Y H:i A',
            'end' => 'required|date_format:m/d/Y H:i A',
            'event_type' => 'required|exists:event_category,id',
            'state' => 'required|exists:states,abbreviation',
            'city' => 'required|string|max:50',
            'zipcode' => 'required|string|max:25',
            'address' => 'required|string|max:255',
            'credits' => 'required|integer',
            'age' => 'required|integer|min:0|max:1',

        ]);

    }

    public function create(Request $request)
    {
        $data = $request->all();
        // get the timezone based on the state
        $tz = $this->getTimeZoneFromState($data['state']);

        // convert this to server time.
        $start = $this->ConvertTimeToUTC($data['start'], $tz);
        $end = $this->ConvertTimeToUTC($data['end'], $tz);

        $user = Auth::user();
        $event = new Event([
                    'organization_id' => $user->organization_id,
                    'name' => $data['title'],
                    'start_time' => $start,
                    'end_time' => $end,
                    'credits' => $data["credits"],
                    'description' => $data['desc'],
                    'screening_required' => false,
                    'age_requirement' => $data['age'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'zipcode' => $data['zipcode'],
                    'address' => $data['address'],
                    'org_category' => $user->organization->category,
                    'category' => $data["event_type"],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'max_users' => 0,
                    'status' => 'pending'

            ]
        );

        $event->save();

        $imageName = $event->id . '.jpg';
        $request->file('image')->move(
            base_path() . '/public/images/events/', $imageName
        );


        return redirect(url('/' .$event->organization->slug . '/events/'. $event->slug));
    }

    public function ConvertTimeToUTC($time, $timezone){
        $localTime = Carbon::createFromFormat('m/d/Y H:i A', $time, $timezone);
        return Carbon::createFromTimestamp($localTime->timestamp, config('app.timezone'));
    }

    public function ConvertTimeToLocal($time, $timezone) {

        return Carbon::createFromTimestamp($time->timestamp, $timezone);
    }
    public function getTimeZoneFromState($state){

        $TimeZones = array(
            'ME' => 'US/Eastern',
            'NH' => 'US/Eastern',
            'MA' => 'US/Eastern',
            'VT' => 'US/Eastern',
            'RI' => 'US/Eastern',
            'NY' => 'US/Eastern',
            'CT' => 'US/Eastern',
            'NJ' => 'US/Eastern',
            'DE' => 'US/Eastern',
            'MD' => 'US/Eastern',
            'PA' => 'US/Eastern',
            'WV' => 'US/Eastern',
            'VA' => 'US/Eastern',
            'NC' => 'US/Eastern',
            'SC' => 'US/Eastern',
            'GA' => 'US/Eastern',
            'FL' => 'US/Eastern',
            'OH' => 'US/Eastern',
            'MI' => 'US/Eastern',
            'IN' => 'US/Eastern',
            'KY' => 'US/Eastern',
            'WI' => 'US/Central',
            'IL' => 'US/Central',
            'TN' => 'US/Central',
            'AL' => 'US/Central',
            'MN' => 'US/Central',
            'IA' => 'US/Central',
            'MO' => 'US/Central',
            'AR' => 'US/Central',
            'MS' => 'US/Central',
            'LA' => 'US/Central',
            'ND' => 'US/Central',
            'SD' => 'US/Central',
            'NE' => 'US/Central',
            'KS' => 'US/Central',
            'OK' => 'US/Central',
            'TX' => 'US/Central',
            'MT' => 'US/Mountain',
            'WY' => 'US/Mountain',
            'CO' => 'US/Mountain',
            'NM' => 'US/Mountain',
            'ID' => 'US/Mountain',
            'UT' => 'US/Mountain',
            'AZ' => 'US/Mountain',
            'WA' => 'America/Los_Angeles',
            'OR' => 'America/Los_Angeles',
            'NV' => 'America/Los_Angeles',
            'CA' => 'America/Los_Angeles',
            'AK' => 'US/Alaska',
            'HI' => 'Pacific/Honolulu',
         );

        return $TimeZones[$state];
    }


}