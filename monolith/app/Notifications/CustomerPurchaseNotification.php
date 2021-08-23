<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;

class CustomerPurchaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $orderId;
    protected $channelName;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @param int $orderId
     * @param string $channelName
     */
    public function __construct(int $orderId, string $channelName)
    {
        $this->orderId = $orderId;
        $this->channelName = $channelName;
        $this->message = "У вас новая покупка, {$this->orderId}";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['database', $this->channelName];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->message)
            ->action('Notification Action', url('/'));
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content($this->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'message' => $this->message,
        ];
    }
}
