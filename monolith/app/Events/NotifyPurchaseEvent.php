<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyPurchaseEvent
{
    use Dispatchable, SerializesModels;

    public $orderId;
    public $channelName;

    /**
     * Create a new event instance.
     *
     * @param int $orderId
     * @param string $channelName
     */
    public function __construct(int $orderId, string $channelName)
    {
        $this->orderId = $orderId;
        $this->channelName = $channelName;
    }
}
