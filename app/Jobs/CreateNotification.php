<?php

namespace App\Jobs;

use App\User;
use App\Notification;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Mail;
class CreateNotification extends Job implements SelfHandling
{

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
        $user = User::Where('id', '=', $this->userId)->take(1)->get();

        if(!$user->IsEmpty() ) {
            $Notify = new Notification([
                "user_id" => $this->userId,
                "message" => $this->message
            ]);
            $Notify->save();

            $data = ['user' => $user, 'message' => $this->message];
            Mail::queue('emails.notification', $data, function ($message) use ($data) {
                $message->from("noreply@pleasantville.co","PleasantVille.co");
                $message->to($data->user->email, $data->user->first_name)->subject('Notification from PleasantVille.co!');
            });
        }


    }
}
