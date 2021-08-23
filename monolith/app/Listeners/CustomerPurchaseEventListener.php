<?php

namespace App\Listeners;

use App\Events\NotifyPurchaseEvent;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomerPurchaseEventListener implements ShouldQueue
{
    /** @var NotificationService $notificationService */
    protected $notificationService;

    /**
     * Create the event listener.
     *
     * @param NotificationService $notificationService
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Handle the event.
     *
     * @param NotifyPurchaseEvent $event
     * @return void
     */
    public function handle(NotifyPurchaseEvent $event)
    {
        $this->notificationService->notifyCustomerAboutNewPurchase($event->orderId, $event->channelName);
    }
}
