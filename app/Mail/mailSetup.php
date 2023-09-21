<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class mailSetup extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    //  protected $uEmail;
    //  protected $loginLink;
    protected $Subject;
    protected $ReferralCode;
    protected $contestName;
    protected $startDate;
    protected $endDate;
    protected $contestLimit;
    protected $winningPrize;
    protected $currentDomain;


    public function __construct($Subject, $ReferralCode, $contestName, $startDate, $endDate, $contestLimit, $winningPrize,$currentDomain)
    {
        $this->Subject  = $Subject;
        $this->ReferralCode = $ReferralCode;
        $this->contestName = $contestName;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->contestLimit = $contestLimit;
        $this->winningPrize = $winningPrize;
        $this->currentDomain = $currentDomain;
    }

    public function build()
    {
        $result  = $this->view('Emails.invitationMail')
            ->subject($this->Subject)
            ->with("ReferralCode", $this->ReferralCode)
            ->with("contestName", $this->contestName)
            ->with("startDate", $this->startDate)
            ->with("endDate", $this->endDate)
            ->with("contestLimit", $this->contestLimit)
            ->with("winningPrize", $this->winningPrize)
            ->with("currentDomain", $this->currentDomain);
        return $result;
    }
}
