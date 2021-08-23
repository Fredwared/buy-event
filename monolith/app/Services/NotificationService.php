<?php

namespace App\Services;

use App\Models\Order;
use App\Notifications\CustomerPurchaseNotification;
use Illuminate\Support\Facades\Notification;

/**
 * Class NotificationService
 * @package App\Services
 */
class NotificationService
{
    public function notifyCustomerAboutNewPurchase(int $orderId, string $channelName)
    {
        /** @var Order $order */
        $order = Order::query()->find($orderId);

        Notification::send($order->customer, new CustomerPurchaseNotification($orderId, $channelName));
    }
}
