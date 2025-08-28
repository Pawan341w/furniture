<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
         return (new \Illuminate\Notifications\Messages\MailMessage)
        ->subject('Order Status Updated')
        ->view('emails.orders.order-status-updated', ['order' => $this->order]);
    }
}
