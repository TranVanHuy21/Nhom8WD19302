<?php
namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Cập nhật trạng thái đơn hàng #' . $this->order->id)
            ->line('Đơn hàng của bạn đã được cập nhật sang trạng thái: ' . $this->order->status)
            ->action('Xem chi tiết đơn hàng', route('orders.show', $this->order))
            ->line('Cảm ơn bạn đã mua hàng tại cửa hàng chúng tôi!');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'status' => $this->order->status
        ];
    }
}