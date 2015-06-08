<?php namespace App;


use App\Group;
use App\Volunteer;
use App\Organization;
use App\ScreeningData;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'group_id', 'organization_id', 'role'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id', 'password', 'remember_token'];



    public function volunteer()
    {
        return $this->belongsTo('App\Volunteer', 'id', 'user_id');
    }

    public function user(){

        return $this->belongsTo('App\User');

    }
    public function IsMember()
    {
         return !is_null($this->group_id);
    }

    public function IsOrganization(){

        return !is_null($this->organization_id);
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function organization() {

        return $this->belongsTo('App\Organization');
    }

    public function CheckedIn($EventId){

        $checked = Attendance::where('user_id', '=', $this->id)->where('event_id', '=', $EventId)->get();


        return $checked->isEmpty();

    }


    public function IsVerified() {

        $data = ScreeningData::Where('user_id', '=', $this->id)->get();

        if(!$data->IsEmpty()) {

            $data = $data[0];


            if($data->status == "accepted") {
                 return true;
            }
        }

        return false;

    }


}
