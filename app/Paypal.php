<?php



namespace App;





class Paypal {



    private $_apiContext;

    private $shopping_cart;

    
    private $_ClientId;
    private $_ClientSecret;


    public function __construct($shopping_cart)

    {
        $this->_ClientId  = env('CLIENT_ID');
        $this->_ClientSecret = env('CLIENT_SECRET');
        

        $this->_apiContext = \PaypalPayment::ApiContext($this->_ClientId, $this->_ClientSecret);



        $config = config("paypal_payment");

        $flatConfig = array_dot($config);



        $this->_apiContext->setConfig($flatConfig);



        $this->shopping_cart = $shopping_cart;

    }



    public function generate()

    {

        // dd($this->_ClientSecret);

        $payment = \PaypalPayment::payment()->setIntent("sale")

            ->setPayer($this->payer())

            ->setTransactions([$this->transaction()])

            ->setRedirectUrls($this->redirectURLs());



        try {

            $payment->create($this->_apiContext);

        } catch (\Exception $ex) {

            dd($ex);

            exit(1);

        }



        return $payment;



    }



    public function payer()

    {

        // Returns payment's info

        return \PaypalPayment::payer()->setPaymentMethod("paypal");

    }



    public function amount()

    {

        return \PaypalPayment::amount()->setCurrency("USD")->setTotal($this->shopping_cart->total());

    }



    public function transaction()

    {

        // Returns transaction's info

        return \PaypalPayment::transaction()->setAmount($this->amount())->setItemList($this->items())->setDescription("Tu compra en TuFarmaciaLatina")->setInvoiceNumber(uniqid());

    }



    public function items()

    {

        $items = [];



        $products = $this->shopping_cart->products()->get();



        foreach ($products as $product) {

            array_push($items, $product->paypalItem());

        }



        /*$promotions = $this->shopping_cart->promotions()->get();



        foreach ($promotions as $promotion) {

            array_push($items, $promotions->paypalItem());

        }*/



        //dd($items);

        return \PaypalPayment::itemList()->setItems($items);

    }



    public function redirectURLs()

    {

        // Returns transaction's info

        $baseURL = url('/');



        return \PaypalPayment::redirectUrls()

            ->setReturnUrl("$baseURL/payments/store")

            ->setCancelUrl("$baseURL/carrito");

    }



    public function execute($paymentId, $payerId)

    {

        $payment = \PaypalPayment::getById($paymentId, $this->_apiContext);



        $execution = \PaypalPayment::PaymentExecution()

            ->setPayerId($payerId);



        return $payment->execute($execution, $this->_apiContext);

    }





}