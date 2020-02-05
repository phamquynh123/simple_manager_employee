<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\User\UserRepositoryInterface;
use App\Model\User;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $UserRepo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( 
        User $user
        // UserRepositoryInterface $UserRepo
    ) {
        $this->user = $user;
        // $this->UserRepo = $UserRepo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.sendEmail');
    }
}
