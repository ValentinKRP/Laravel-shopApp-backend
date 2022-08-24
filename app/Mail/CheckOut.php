<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckOut extends Mailable
{
    use Queueable;
    use SerializesModels;


    public $orderItems;
    public $order;

    public function __construct($order, $orderItems)
    {
        $this->order = $order;
        $this->orderItems = $orderItems;
    }

    public function build()
    {
        return $this->view('template')->with(['order' => $this->order,'orderItems' => $this->orderItems]);
    }
}
