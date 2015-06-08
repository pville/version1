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
use Redirect;
use Illuminate\Support\Facades\DB;

class EventController extends Controller {

    protected $redirectPath = "/events/create";

    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function getCreateEvent(){
        if(Auth::check())
        {
            return view("events.create");
        }
    }

    public function getEvent($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);

            if(!is_null($event)){

                if(Auth::check()) {
                    $user = Auth::user();
                    return view('events.view')->with(compact('user', $user))->with(compact('event', $event));

                }

                return view('events.view', compact('event', $event));
            }
        }
        return redirect($this->redirectPath);
    }


    public function postJoinEvent($OrganizationSlug, $EventSlug) {

        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            $event = Event::findBySlug($EventSlug);

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

                    return view('events.view')->with(compact('user', $user))->with(compact('event', $event));
                }
                return view('events.view', compact('event', $event));
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
            'state' => 'required|exists:states,abbreviation',
            'city' => 'required|string|max:50',
            'zipcode' => 'required|string|max:25',
            'address' => 'required|string|max:255',
            'credits' => 'required|integer',
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

        $event = new Event([
                    'organization_id' => Auth::user()->organization_id,
                    'name' => $data['title'],
                    'start_time' => $start,
                    'end_time' => $end,
                    'credits' => 0,
                    'description' => $data['desc'],
                    'screening_required' => false,
                    'age_requirement' => 0,
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'zipcode' => $data['zipcode'],
                    'address' => $data['address'],
                    'category' => "",
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'max_users' => 0,
                    'status' => 0

            ]
        );

        $event->save();

        $imageName = $event->id . '.' . $request->file('image')->getClientOriginalExtension();

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