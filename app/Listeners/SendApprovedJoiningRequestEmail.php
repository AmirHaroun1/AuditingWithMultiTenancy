<?php

namespace App\Listeners;

use App\Events\JoiningRequestApproved;

use App\Mail\ApprovedJoiningEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendApprovedJoiningRequestEmail implements ShouldQueue
{
    use InteractsWithQueue;
    public $queue = 'emails';

    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 2;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  JoiningRequestApproved  $event
     * @return void
     */
    public function handle(JoiningRequestApproved $event)
    {
        //

        $Tenant = $event->Tenant;
        Mail::to($Tenant->email)->send(new ApprovedJoiningEmail($Tenant));

    }
    /**
     * Handle a job failure.
     *
     * @param  JoiningRequestApproved  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(JoiningRequestApproved $event, $exception)
    {
        //
        \Illuminate\Support\Facades\Log::error($exception);
    }
}
