<?php namespace App\Http\Controllers;

use Auth;
use App\ScreeningData;
use App\User;
use App\Event;
use App\Organization;
use App\Group;
use App\Notification;
use App\Invite;
use App\Blacklist;
use App\Attendance;
use Illuminate\Http\Request;
use Redirect;
use Response;
use Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Toast;
use Mail;
use App\Jobs\CreateNotification;

class DashboardController extends Controller {
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
    protected $redirectPath = "/dashboard";
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

            $Notifications =  Notification::where('user_id','=', $user->id)->select('id','message','created_at')->get();

            if($user->role == "volunteer") {
                // DB::table("event")->leftJoin('attendance', 'event.id', '=', 'attendance.event_id');
                DB::enableQueryLog();
                $Upcoming =  DB::table('event')
                    ->join('attendance', function($join) use ($user)
                    {

                        $join->on('event.id', '=', 'attendance.event_id')
                            ->where('attendance.user_id', '=', $user->id);





                    })
                    ->Where(function ($query) {

                        $query->where('event.status', '=', "pending")
                            ->orWhere('event.status', '=', 'started');
                    })
                    ->orderBy('event.start_time','desc')
                    ->get();

                //dd(DB::getQueryLog());

                $UpcomingEvents = array();

                if(count($Upcoming) > 0) {

                    $index = 0;
                    foreach($Upcoming as $next) {

                        $UpcomingEvents[$index] = $next->event();
                        $index++;

                    }
                }



                // Fd

                /*
                $Completed =  DB::table('event')
                    ->join('attendance', function($join) use ($user)
                    {

                       $join->on('event.id', '=', 'attendance.event_id')
                           ->where('attendance.user_id', '=', $user->id)
                           ->where('attendance.checked_in', '=', true)
                           ->where("event.status", "=", "ended")
                           ->orWhere("event.status", "=", "completed");




                    })
                    ->orderBy('start_time','desc')
                    ->get();

             //   dd(DB::getQueryLog());

                $CompletedEvents = null;

                if(count($Completed) > 0) {

                    $index = 0;
                    $user = Auth::user();
                    foreach ($Completed as $next) {
                        if ($next->user_id == $user->id && $next->checked_in == true)  {
                            if ($index == 0) {
                                $CompletedEvents = Event::Where('id', '=', $next->event_id);
                                $index++;
                            } else {
                                $CompletedEvents->orWhere('id', '=', $next->event_id);
                            }

                        }
                    }
                }

                if(!is_null($CompletedEvents)) {
                    $CompletedEvents = $CompletedEvents->get();

                }*/

                $Completed =  DB::table('event')
                    ->join('attendance', function($join) use ($user)
                    {

                        $join->on('event.id', '=', 'attendance.event_id')
                            ->where('attendance.user_id', '=', $user->id)
                            ->where('attendance.checked_in', '=', true);





                    })
                    ->Where(function ($query) {

                        $query->where('event.status', '=', "ended")
                            ->orWhere('event.status', '=', 'completed');
                    })
                    ->orderBy('event.start_time','desc')
                    ->get();


                $CompletedEvents = array();

                if(count($Completed) > 0) {

                    $index = 0;
                    foreach($Completed as $next) {

                        $CompletedEvents[$index] = $next->event();
                        $index++;

                    }
                }

                return view('dashboard.volunteer')
                    ->with(compact('user', $user))
                    ->with(compact('UpcomingEvents', $UpcomingEvents))
                    ->with(compact('CompletedEvents', $CompletedEvents))
                    ->with(compact('Notifications', $Notifications));
            }
            else if ($user->role == "group") {

                if($user->status == "pending")
                    return view("dashboard.pending");

                if($user->status == "denied")
                    return redirect(url("/logout"));




                $Members = User::where('group_id', '=', $user->group_id)->where('role','=','volunteer')->paginate(15);

                $Members->setPath('/dashboard');

                $Notifications =  Notification::where('user_id','=', $user->id)->select('id','message','created_at')->get();

                // Attendance::Where('user_id','=', $user->id)->Where('checked_in', '=', false)->get();



                return view('dashboard.group')->with(compact('user', $user))->with(compact('Members', $Members))->with(compact('Notifications', $Notifications));
            }

            else if ($user->role == "organization") {
                if($user->status == "pending")
                    return view("dashboard.pending");

                if($user->status == "denied")
                    return redirect(url("/logout"));

                $Notifications =  Notification::where('user_id','=', $user->id)->select('id','message','created_at')->get();
                $UpcomingEvents =  Event::whereRaw("organization_id = " . $user->organization_id . " AND (status = 'pending' OR status = 'started')")
                    ->orderBy('start_time','desc')
                    ->get();

                $CompletedEvents = Event::whereRaw("organization_id = " . $user->organization_id . " AND ( status = 'ended' OR status = 'completed')")
                    ->orderBy('start_time','desc')
                    ->get();



                return view('dashboard.organization')
                    ->with(compact('user', $user))
                    ->with(compact('UpcomingEvents', $UpcomingEvents))
                    ->with(compact('CompletedEvents', $CompletedEvents))
                    ->with(compact('Notifications', $Notifications));

            }
            else if($user->role == "admin") {
                $Members = User::whereRaw("users.status = 'pending' AND ( users.role = 'organization' OR users.role = 'group' )")->paginate(15);


                $Members->setPath('/dashboard');

                return view('dashboard.admin')->with(compact('user', $user))->with(compact('Members', $Members));
            }
        }


        return redirect(url("/"));
    }

    public function postFilterOrganization(Request $request) {

        if(Auth::check()) {
            $user = Auth::user();
            $data = $request->all();
            unset($data["_token"]);

            $Org = array();

            $i = 0;
            foreach($data as $key)
            {
                $Org[$i] = $key;
                $i++;
            }




            $user->group->org_rules= json_encode($Org);
            $user->group->save();

            return redirect(url("/dashboard"));
        }

        return redirect(url("/"));

    }

    public function getRules() {

        if(Auth::check()) {
            $user = Auth::user();


        }

    }

    public function postAddBlacklist($id) {

        if(Auth::check()) {
            $user = Auth::user();

            $ban = new BlackList([
                "group_id" => $user->group_id,
                "organization_id" => $id
            ]);
            $ban->save();
        }

        //return redirect(url("/"));
    }

    public function postDelBlacklist($id) {

        if(Auth::check()) {
            $user = Auth::user();


            $ban = Blacklist::Where("group_id", "=", $user->group_id)->where("organization_id", "=", $id)->take(1)->get();

            if(!$ban->isEmpty()) {
                $ban = $ban[0];
                $ban->delete();
            }
        }

        //return redirect(url("/"));
    }

    public function getBlacklistData() {

        if(Auth::check()) {
            $user = Auth::user();

            if ($user->role == "group") {


                $bans = Blacklist::Where("group_id", "=", $user->group_id)->select('organization_id')->get();

                if (!$bans->isEmpty()) {

                    $data = array();

                    $index = 0;
                    foreach($bans as $ban) {
                        $data[$index] = $ban->organization_id;
                        $index++;
                    }


                    return Response::json(array(
                        'success' => true,
                        'data' => json_encode($data)
                    ));

                } else {
                    return Response::json(array(
                        'success' => false

                    ));
                }
            }
        }
    }
    public function getBlacklist() {

        if(Auth::check()) {
            $user = Auth::user();


            $bans = Blacklist::Where("group_id", "=", $user->group_id)->get();
            $orgs = Organization::paginate(15);


            return view("dashboard.settings.blacklist")
                ->with(compact("bans", $bans))
                ->with(compact("orgs", $orgs));


        }

        return redirect(url("/"));
    }
    public function postFilterEvents(Request $request) {

        if(Auth::check()) {
            $user = Auth::user();
            $data = $request->all();
            unset($data["_token"]);

            $Org = array();

            $i = 0;
            foreach($data as $key)
            {
                $Org[$i] = $key;
                $i++;
            }



            $user->group->event_rules= json_encode($Org);
            $user->group->save();

            return redirect(url("/dashboard"));
        }

        return redirect(url("/"));

    }

    public function postApproval(Request $request) {

        if(Auth::check()) {
            $user = Auth::user();
            $data = $request->all();

            if ($data["approval"] == "approved" || $data["approval"] == "denied") {

                if ($user->role == "admin") {

                    $member = User::where('id', '=', $data['user_id'])->take(1)->get();


                    if(!is_null($member)) {
                        $member  = $member[0];
                        $member->status = $data["approval"];
                        $member->save();
                    }

                    $Members = User::whereRaw("users.status = 'pending' AND ( users.role = 'organization' OR users.role = 'group' )")->paginate(15);




                    $Members->setPath('/dashboard');

                    return view('dashboard.admin')->with(compact('user', $user))->with(compact('Members', $Members));
                }
            }

        }

        return redirect(url("/"));
    }

    public function getFilter() {

        if(Auth::check()) {
            $user = Auth::user();

            if($user->role == "group") {

                $minutes = Carbon::now()->addMinutes(1);


                $OrgTypes = Cache::remember('organization_category_filter', $minutes, function () {
                    return DB::table('organization_category')->select('id', 'type','checked')->get();
                    //return DB::table('groups')->select('id', 'name')->get()->skip(1);
                });

                $EventTypes = Cache::remember('event_category_filter', $minutes, function () {
                    return DB::table('event_category')->select('id', 'type', 'checked')->get();
                    //return DB::table('groups')->select('id', 'name')->get()->skip(1);
                });

                if($user->group->org_rules != '') {
                    foreach (json_decode($user->group->org_rules) as $Org) {

                        foreach($OrgTypes as $OrgObj)
                        {


                            if($OrgObj->id == intval($Org))
                              $OrgObj->checked = true;

                        }

                    }


                }


                if($user->group->event_rules != '') {
                    foreach (json_decode($user->group->event_rules) as $Ev) {

                        foreach($EventTypes as $EvObj)
                        {


                            if($EvObj->id == intval($Ev))
                                $EvObj->checked = true;

                        }

                    }


                }
                return view("dashboard.settings.rules")->with(compact('user', $user))->with(compact("OrgTypes",$OrgTypes))->with(compact("EventTypes",$EventTypes));
            }
        }

        return redirect(url("/"));

    }
    public function postEdit(Request $request) {

        if(Auth::check())
        {
            $user = Auth::user();

            $type = $user->role;

            $validator = $this->getValidator($type, $request->all());

            if ($validator->fails())
            {
                $this->throwValidationException(
                    $request, $validator
                );

                return redirect($this->redirectPath());
            }

            $this->getUpdate($type, $request->all());

            return redirect(url('/dashboard'));
        }

        return view('/');
    }

    public function getValidator($type, array $data)
    {
        if($type == "volunteer") return false;
        else if($type == "group") return $this->GroupValidator($data);
        else if($type == "organization") return $this->OrgValidator($data);

    }

    public function getUpdate($type, array $data)
    {
        if($type == "Volunteer") return false;
        else if($type == "group") return $this->GroupUpdate($data);
        else if($type == "organization") return $this->OrgUpdate($data);
    }

    public function GroupValidator(array $data) {

        return Validator::make($data, [

            'group_phone_number' => 'required|max:20',
            'group_name' => 'required|max:255',
            'group_type' => 'required|integer|exists:group_types,id',
            'group_email' => 'required|email|max:255',
            'group_credits' => 'required|integer',

        ]);
    }

    public function OrgValidator(array $data) {

        return Validator::make($data, [




            'org_phone_number' => 'required|max:20',
            'org_name' => 'required|max:255',
            'org_email' => 'required|email|max:255',
            'org_address' => 'required|max:255',
            'org_desc' => 'required|max:1000'


        ]);
    }

    public function GroupUpdate(array $data) {

        $user = Auth::user();



        $Group = Group::find($user->group->id);
        $Group->name = $data['group_name'];
        $Group->type = $data['group_type'];
        $Group->target_credits = $data['group_credits'];
        $Group->state = $data['state'];
        $Group->city = $data['group_city'];
        $Group->zipcode = $data['group_zipcode'];
        $Group->address = $data['group_address'];
        $Group->phone = $data['group_phone_number'];
        $Group->email = $data['group_email'];





        $Group->save();




        return $Group;
    }

    public function OrgUpdate(array $data) {

        $user = Auth::user();


        $Org = Organization::find($user->organization->id);
        $Org->category = $data['org_cat'];
        $Org->name = $data['org_name'];
        $Org->state = $data['state'];
        $Org->city = $data['org_city'];
        $Org->zipcode = $data['org_zipcode'];
        $Org->address = $data['org_address'];
        $Org->phone = $data['org_phone_number'];
        $Org->description = $data['org_desc'];
        $Org->email = $data['org_email'];
        $Org->url = $data['url'];

        $Org->resluggify();
        $Org->save();




        return $Org;
    }

    public function getEdit()
    {
        if(Auth::check())
        {
            $user = Auth::user();

            if($user->role == "volunteer")
                return view('dashboard.volunteer', compact('user', $user));

            else if ($user->role == "group") {
                //$Members = User::where('group_id', '=', $user->group->id)->where('role','=','volunteer')->paginate(15);

                //$Members->setPath('/dashboard');

                $minutes = Carbon::now()->addMinutes(30);


                // use a cache to reduce mysql queries
                $group_types = Cache::remember('group_types', $minutes, function()
                {
                    return DB::table('group_types')->select('id', 'type')->get();
                });


                return view('dashboard.edit.group')->with(compact('user', $user))->with(compact('group_types',$group_types));//->with(compact('Members', $Members));
            }

            else if ($user->role == "organization") {

                $org = $user->organization;

                $minutes = Carbon::now()->addMinutes(1);



                $OrgTypes = Cache::remember('organization_category', $minutes, function()
                {
                    return DB::table('organization_category')->select('id', 'type')->get();
                    //return DB::table('groups')->select('id', 'name')->get()->skip(1);
                });



                return view('dashboard.edit.organization')
                    ->with(compact('user', $user))
                    ->with(compact('org',$org))
                    ->with(compact("OrgTypes",$OrgTypes));
            }
        }

        return redirect(url("/"));
    }
    public function postInviteUser(Request $request)
    {
        if(Auth::check()) {
            $user = Auth::user();
            if ($user->role == "organization" || $user->role == "group") {
                $validator = $this->validator($request->all());

                if ($validator->fails()) {
                    $this->throwValidationException(
                        $request, $validator
                    );
                }

                return $this->create($request->all());
            }

            return redirect(url("/dashboard"));
        }

        return redirect(url("/"));

    }

    public function validator(array $data) {

        return Validator::make($data, [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
        ]);

    }

    public function getScreening() {

        if(Auth::check())
        {
            $user = Auth::user();

            if ($user->role == "organization") {
                $screening = ScreeningData::Where('organization_id', '=', $user->organization->id)->Where('status', '=', 'pending')->paginate(15);
                return view('dashboard.screening', compact('screening', $screening));

            }
        }

        return redirect(url("/"));
    }

    public function postVerifyUser(Request $request)
    {
        $data = $request->all();
        if ($data["approval"] == "accepted" || $data["denied"]) {


            if (Auth::check()) {
                $user = Auth::user();


                if ($user->role == "organization") {


                    $screen = ScreeningData::Where('id', '=', $data["user_id"])->get();
                    if (!$screen->isEmpty()) {
                        $screen = $screen[0];
                        $screen->status = $data["approval"];
                        $screen->save();



                        $this->dispatch(new CreateNotification($screen->user_id, "You have been " . $data["approval"]
                            . " for organization " . $user->organization->name));


                        return redirect(url("/dashboard/screening"));
                    }

                }
            }
        }

        return redirect(url("/"));
    }

    public function create(array $data)
    {
        $user = Auth::user();
        $id_type = "organization_id";
        $id = 0;
        if($user->role == "organization") {
            $id_type = "organization_id";
            $id = $user->organization->id;
        }
        else if($user->role == "group") {
            $id_type = "group_id";
            $id = $user->group->id;
        }

        $invite = new Invite([
                $id_type => $id,
                "first_name" => $data["first_name"],
                "last_name" => $data["last_name"],
                "email" => $data["email"],
                "invite_code" => hash('sha256', Hash::make(Carbon::now()->timestamp))
         ]);

        $invite->save();

        Toast::success('Invite sent to ' . $data["email"], 'Success!');

        Mail::queue('emails.invite', ['first_name' => $invite->first_name, 'last_name' => $invite->last_name,
            'hash' => $invite->invite_code], function ($m) use ($invite) {
            $m->from("noreply@pleasantville.co","PleasantVille.co");
            $m->to($invite->email, $invite->first_name)->subject('Invite for PleasantVille.co!');
        });

        return redirect(url('/dashboard'));

    }

    public function getReset() {

        return View("auth.password");
    }
}