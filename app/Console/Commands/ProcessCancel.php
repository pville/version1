<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Event;
use App\Attendance;
use App\Notification;
use Carbon\Carbon;

class ProcessCancel extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'process-cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Canceled Events.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {

        $Events = Event::Where('status', '=', 'canceling')->get();

        if(!$Events->isEmpty() ) {

            foreach($Events as $Event)
            {
                $Event->status = "canceled";
                $Event->save();

                $Users = Attendance::where('event_id', '=', $Event->id)->get();

                foreach($Users as $User) {

                    $Notify = new Notification([
                        "user_id" => $User->user_id,
                        "message" => "Event " . $Event->name . " has been canceled."
                    ]);
                    $Notify->save();
                }
            }
        }


    }


}
