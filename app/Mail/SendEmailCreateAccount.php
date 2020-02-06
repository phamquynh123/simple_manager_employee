<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\User\UserRepositoryInterface;
use App\Model\User;

class SendEmailCreateAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct( 
    //     User $user
    //     // UserRepositoryInterface $UserRepo
    // ) {
    //     $this->user = $user;
    //     // $this->UserRepo = $UserRepo;
    // }

    public function __construct($data)
    {
        $this->data = $data;
        // dd($data);
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendEmailCreateAccount', compact($this->data));
    }
}
