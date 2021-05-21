<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class ApprovedJoiningEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $Tenant , $activationURL;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Tenant)
    {
        //
        $this->Tenant = $Tenant;
        $this->activationURL = URL::temporarySignedRoute('activate.subscription', now()->addMinutes(30) ,['TenantID' => $this->Tenant->id]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('hey')->view('maileclipse::templates.YourRequestHasBeenApproved');

    }
}
