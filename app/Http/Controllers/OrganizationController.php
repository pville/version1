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

class OrganizationController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }





    public function getProfile($OrganizationSlug) {


        $org = Organization::findBySlug($OrganizationSlug);

        if(!is_null($org))
        {
            return view('profile')->with(compact('org', $org));
        }

        return redirect(url('/'));

    }



}

?>