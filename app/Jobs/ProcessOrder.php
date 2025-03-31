<?php
namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderConfirmation;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        // Xử lý đơn hàng
        $this->updateInventory();
        $this->sendNotification();
    }

    protected function updateInventory()
    {
        foreach ($this->order->items as $item) {
            $product = $item->product;
            $product->decrement('stock', $item->quantity);
        }
    }

    protected function sendNotification()
    {
        // Gửi email thông báo
        Mail::to($this->order->user->email)->send(new OrderConfirmation($this->order));
    }
}