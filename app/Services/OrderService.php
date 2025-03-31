<?php
namespace App\Services;

use App\Models\Order;
use App\Events\OrderStatusChanged;
use App\Jobs\ProcessOrder;

class OrderService
{
    public function createOrder($data)
    {
        $order = Order::create($data);
        ProcessOrder::dispatch($order);
        return $order;
    }

    public function updateStatus(Order $order, $newStatus)
    {
        $oldStatus = $order->status;
        $order->update(['status' => $newStatus]);

        event(new OrderStatusChanged($order, $oldStatus, $newStatus));
        return $order;
    }
}