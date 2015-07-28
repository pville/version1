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
            $user = $user[0];
            $Notify = new Notification([
                "user_id" => $this->userId,
                "message" => $this->message
            ]);
            $Notify->save();

            $data = ['user' => $user, 'message' => $this->message];
            Mail::send('emails.notification', $data , function ($message) use ($data) {
                $message->from("noreply@pleasantville.co","PleasantVille.co");
                $message->to($data['user']->email, $data['user']->first_name)->subject('Notification from PleasantVille.co!');
            });
        }


    }
}
