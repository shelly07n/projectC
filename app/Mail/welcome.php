<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class welcome extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     */

    //  protected $uEmail;
    //  protected $loginLink;
    protected $Subject;
    protected $userName;
    protected $userEmail;
    protected $password;
    protected $currentDomain;




    public function __construct($Subject, $userName, $userEmail, $password,$currentDomain)
    {
        $this->Subject  = $Subject;
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->password = $password;
        $this->currentDomain = $currentDomain;
    }

    public function build()
    {
        $result  = $this->view('Emails.welcomeInvitation')
            ->subject($this->Subject)
            ->with("userName", $this->userName)
            ->with("userEmail", $this->userEmail)
            ->with("password", $this->password)
            ->with("currentDomain", $this->currentDomain);
        return $result;
    }
}
