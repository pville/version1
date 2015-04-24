<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;


class Organization extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'organizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'logo', 'email', 'phone', 'address', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['user_id', 'type'];
    
   
}
