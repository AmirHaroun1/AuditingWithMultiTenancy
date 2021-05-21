<?php

namespace App\Events;

use App\Tenant;
use App\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class JoiningRequestApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $Tenant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($Tenant)
    {

        $this->Tenant = $Tenant;
        //$Tenant->activation_token = Str::random(10);
        //$Tenant->save();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new PrivateChannel('Email-channel');
    }
}
