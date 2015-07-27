<?php

namespace App\Jobs;

use App\User;
use App\Notification;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class CreateNotification extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    protected $userId;
    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId, $message)
    {
        $this->userId = $userId;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::Where('id', '=', $this->userId)->get();

        if(!$user->IsEmpty() ) {
            $Notify = new Notification([
                "user_id" => $this->userId,
                "message" => $this->message
            ]);
            $Notify->save();


            Mail::send('emails.notification', ['user' => $user, 'message' => $this->message], function ($message) use ($user) {
                $message->from("noreply@pleasantville.co","PleasantVille.co");
                $message->to($user->email, $user->first_name)->subject('Notification from PleasantVille.co!');
            });
        }


    }
}
