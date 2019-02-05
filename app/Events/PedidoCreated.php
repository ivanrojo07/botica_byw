<?php

namespace App\Events;

use App\ShoppingCart;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PedidoCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $shopping_cart;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ShoppingCart $shopping_cart)
    {
        //
        $this->shopping_cart = $shopping_cart;
        $this->message = "El pedido {$shopping_cart->id} a sido creado";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('pedido-created');   
    }

    public function broadcastAs()
    {
        return 'pedido-creado';
    }
}
