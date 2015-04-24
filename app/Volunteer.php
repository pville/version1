<?php namespace App;

use App\Volunteer;
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
    protected $fillable = ['birthdate', 'target_credits', 'current_credits', 'type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['user_id', 'type'];
    


    public function user() {

        return $this->belongsTo('App\User');
    }
    


    public function age() {

        // TODO: function to calculate age from birthdate field.
        // 
    }
}
