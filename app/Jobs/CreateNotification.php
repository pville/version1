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
    public function __construct($userId,$message)
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
        $user = User::findOrFail($this->userId);

        $Notify = new Notification([
            "user_id" => $this->userId,
            "message" => $this->message
        ]);
        $Notify->save();


        Mail::queue('emails.notification', ['user' => $user, 'message' => $this->message], function ($m) use ($user) {
            $m->from("noreply@pleasantville.co","PleasantVille.co");
            $m->to($user->email, $user->first_name)->subject('Notification from PleasantVille.co!');
        });

    }
}
