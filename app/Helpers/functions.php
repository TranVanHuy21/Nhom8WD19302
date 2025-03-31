<?php

if (!function_exists('format_money')) {
    function format_money($amount)
    {
        return number_format($amount, 0, ',', '.') . 'đ';
    }
}

if (!function_exists('get_order_status_class')) {
    function get_order_status_class($status)
    {
        return [
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger'
        ][$status] ?? 'secondary';
    }
}