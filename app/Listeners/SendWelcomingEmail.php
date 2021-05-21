<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\NewOfficeAskingForJoining;
use App\Mail\WelcomingEmail;


class SendWelcomingEmail implements ShouldQueue
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

    }

    /**
     * Handle the event.
     *
     * @param  NewOfficeAskingForJoining  $event
     * @return void
     */
    public function handle(NewOfficeAskingForJoining $event)
    {
        //

        $user = $event->user;

        Mail::to($user)->send(new WelcomingEmail($user));
    }
    /**
     * Handle a job failure.
     *
     * @param  \App\Events\NewOfficeAskingForJoining  $event
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(NewOfficeAskingForJoining $event, $exception)
    {
        //


    }
}
