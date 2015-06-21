<?php namespace App\Http\Controllers;

use Auth;
use App\ScreeningData;
use App\User;
use App\Organization;
use App\Group;
use App\Notification;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Toast;

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

            if($user->role == "volunteer")
                return view('dashboard.volunteer')->with(compact('user', $user))->with(compact('Notifications', $Notifications));

            else if ($user->role == "group") {

                if($user->status == "pending")
                    return view("dashboard.pending");

                if($user->status == "denied")
                    return redirect(url("/logout"));


                $Members = User::where('group_id', '=', $user->group_id)->where('role','=','volunteer')->paginate(15);

                $Members->setPath('/dashboard');



                return view('dashboard.group')->with(compact('user', $user))->with(compact('Members', $Members))->with(compact('Notifications', $Notifications));
            }

            else if ($user->role == "organization") {
                if($user->status == "pending")
                    return view("dashboard.pending");

                if($user->status == "denied")
                    return redirect(url("/logout"));

                return view('dashboard.organization', compact('user', $user));
            }
            else if($user->role == "admin") {
                $Members = User::whereRaw("users.status = 'pending' AND ( users.role = 'organization' OR users.role = 'group' )")->paginate(15);


                $Members->setPath('/dashboard');

                return view('dashboard.admin')->with(compact('user', $user))->with(compact('Members', $Members));
            }
        }


        return view('/');
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

            if($user->role == "group"){

                $minutes = Carbon::now()->addMinutes(1);



                $OrgTypes = Cache::remember('organization_category', $minutes, function()
                {
                    return DB::table('organization_category')->select('id', 'type')->get();
                    //return DB::table('groups')->select('id', 'name')->get()->skip(1);
                });

                $EventTypes = Cache::remember('event_category', $minutes, function()
                {
                    return DB::table('event_category')->select('id', 'type')->get();
                    //return DB::table('groups')->select('id', 'name')->get()->skip(1);
                });



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
        //else if($type == "group") return $this->GroupUpdate($data);
        else if($type == "organization") return $this->OrgUpdate($data);
    }

    public function GroupValidator(array $data) {

        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'phone_number' => 'required|max:20',
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
                $Members = User::where('group_id', '=', $user->group->id)->where('role','=','volunteer')->paginate(15);

                $Members->setPath('/dashboard');

                return view('dashboard.group')->with(compact('user', $user))->with(compact('Members', $Members));
            }

            else if ($user->role == "organization") {
                $org = $user->organization;
                return view('dashboard.edit.organization')->with(compact('user', $user))->with(compact('org',$org));
            }
        }

        return view('/');
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
                if(!$screening->IsEmpty()) {
                    return view('dashboard.screening', compact('screening', $screening));
                }

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

                        $Notify = new Notification([
                            "user_id" => $screen->user_id,
                            "message" => "You have been " . $data["approval"] . " for organization " . $user->organization->name
                        ]);
                        $Notify->save();

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


        return redirect(url('/dashboard'));

    }

    public function getSettings() {

        return "Settings";
    }
}