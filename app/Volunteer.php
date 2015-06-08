<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Volunteer extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'volunteers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'birthdate', 'target_credits', 'current_credits', 'type'];


    //protected $hidden = ['user_id', 'type'];
    public function getDates()
    {
        return ['created_at', 'updated_at', 'birthdate'];
    }

    public function volunteer(){

        return $this->belongsTo('App\Volunteer');

    }

    public function user() {

        return $this->belongsTo('App\User');
    }

    public function age() {

        // TODO: function to calculate age from birthdate field.

        return Carbon::createFromDate(1975, 5, 21)->age;
    }

    public function AgeCheck($minAge){

        if($this->birthdate->age >= $minAge) return true;
        return false;
    }
}
