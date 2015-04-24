<?php namespace App\Services;

use App\User;
use App\Volunteer;
use App\Group;
use App\Organization;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Carbon\Carbon;

class Registrar implements RegistrarContract {
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return redirect('/');
	}


	public function getValidator($type, array $data)
	{
		if($type == "Volunteer") return $this->VolunteerValidator($data);
		else if($type == "Group") return $this->GroupValidator($data);
		else if($type == "Organization") return $this->OrgValidator($data);
	}
	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	
	public function create(array $data)
	{
		return redirect('/');
	}

	public function getCreate($type, array $data)
	{
		if($type == "Volunteer") return $this->VolunteerCreate($data);
		else if($type == "Group") return $this->GroupCreate($data);
		else if($type == "Organization") return $this->lOrgCreate($data);
	}


	public function VolunteerValidator(array $data) {

		return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'phone_number' => 'required|max:20',
			'month' => 'required|integer|digits_between:1,12',
			'day' => 'required|integer|digits_between:1,31',
			'year' => 'required|integer|min:1935|max:2015',
			'gender' => 'required|integer|digits_between:1,2',
			'group_id' => 'required|integer|exists:groups,id',
			'credits' => 'required|integer',
		]);
	}


	public function VolunteerCreate(array $data) {

		$NewUser = User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'group_id' => $data['group_id'],
			'role' =>	'volunteer'
		]);


		$NewVolunteer = Volunteer::create(
			[
				'user_id' => $NewUser->id,
				'birthdate' => Carbon::createFromDate($data['year'], $data['month'], $data['day'])
			]);

		return $NewUser;
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


	public function GroupCreate(array $data) {

		$NewUser = User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'role' => 'group',
		]);
		
		$NewGroup = Group::create(
			[
				'name' => $data['group_name'],
				'type' => $data['group_type'],
				'target_credits' => $data['group_credits']
				
			]);

		$NewUser->group_id = $NewGroup->id;
		$NewUser->save();

		return $NewUser;
	}


	public function OrgValidator(array $data) {

		return Validator::make($data, [
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'phone_number' => 'required|max:20',
			'org_name' => 'required|max:255',
			'org_email' => 'required|email|max:255',
			'org_address' => 'required|max:255',
			'org_desc' => 'required|max:1000'

			
		]);
	}


	public function OrgCreate(array $data) {

		$NewUser = User::create([
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'role' => 'organization',
		]);
		
		$NewOrg = Organization::create(
			[
				'name' => $data['org_name'],
				'phone' => $data['org_phone_number'],
				'description' => $data['org_desc'],
				'address' => $data['org_address'],
				'email' => $data['org_email']
				
				
			]);

		$NewUser->organization_id = $NewOrg->id;
		$NewUser->save();

		return $NewUser;
	}
}