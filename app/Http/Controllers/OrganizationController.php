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

    public function postInviteUser(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        return $this->create($request->all());
    }

    public function validator(array $data) {

        return Validator::make($data, [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
        ]);

    }

    public function create(array $data)
    {
        $user = Auth::user();

        if($user->role == "organization") {
            $invite = new Invite([
                "organization_id" => $user->organization->id,
                "first_name" => $data["first_name"],
                "last_name" => $data["last_name"],
                "email" => $data["email"],
                "invite_code" => hash('sha256', Hash::make(Carbon::now()->timestamp))
            ]);

            $invite->save();

            Toast::success('Invite sent to ' . $data["email"], 'Success!');


            return redirect(url('/dashboard'));
        }

        return redirect(url('/home'));
    }
}

?>