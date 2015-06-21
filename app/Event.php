<?php namespace App;

use App\User;
use App\Volunteer;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class Event extends \Eloquent implements SluggableInterface {

    use SluggableTrait;


    protected $table = "event";

    protected $fillable = ['organization_id', 'name', 'slug', 'start_time', 'end_time', "credits", "description", "screening_required", "age_requirement", "org_category", "category", "city",
        "state", "address","zipcode", "phone", "email", "max_users", "status"];

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

    public function getDates()
    {
        return ['created_at', 'updated_at', 'start_time', 'end_time'];
    }

    public function organization() {

        return $this->belongsTo('App\Organization');
    }

    public function getMonth($date) {

        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        return $months[$date->month-1];
    }
    public function FriendlyDate($date) {

         $year = $date->year;

        $day = (int)$date->day;
        return sprintf("%d %s %d", $day, $this->getMonth($date), $year);
    }

    public function getEventType() {

        $minutes = Carbon::now()->addMinutes(1);



        $EventTypes = Cache::remember('event_category', $minutes, function()
        {
            return DB::table('event_category')->select('id', 'type')->get();
            //return DB::table('groups')->select('id', 'name')->get()->skip(1);
        });

       return $EventTypes[$this->category - 1]->type;
    }

    public function getAttending() {

        return DB::table('attendance')->where('event_id', '=', $this->id)->count();
    }
}