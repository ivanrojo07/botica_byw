<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;



class OrderCreated extends Mailable

{

    use Queueable, SerializesModels;



    public $order;

    public $products;

    public $url;



    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($order)

    {

        $this->order = $order;

        $this->products = $order->shoppingcart->products;
        $this->url = "http://localhost/botica_byw/public/buscartracking?tracking=".$order->shoppingcart->customid;
        // dd($this->order->shoppingcart);

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

        return $this->from($this->order->email)->subject("Gracias por comprar en TuFarmaciaLatina.com")->markdown('mailers.order');

    }

}

