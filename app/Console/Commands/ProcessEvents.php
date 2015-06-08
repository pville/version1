<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Event;
use Carbon\Carbon;

class ProcessEvents extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'process-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Events.';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
         $Events = Event::Where('end_time', '>=', Carbon::now())->where('status', '=', 0)->get();

        if(!$Events->isEmpty() ) {

            foreach($Events as $Event)
            {
                $Event->status = 1;
                $Event->save();
            }
        }
    }


}
