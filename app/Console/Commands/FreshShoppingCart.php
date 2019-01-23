<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\ShoppingCart;

class FreshShoppingCart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fresh:shoppingCart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        ini_set('memory_limit', '-1');
        $shoppingCarts= ShoppingCart::where([
            ['status','incompleted'],
            ['user_id', NULL],
            ['direccion_id',NULL],
            ['total',0.00],
            ['totalenvio',0.00],
            ['receta_path',''],
            ['customid',NULL]
        ])->whereDate('updated_at','<', \Carbon\Carbon::today())->orderBy('updated_at','desc');
        foreach ($shoppingCarts as $shoppingCart) {
            $inShoppingCarts=$shoppingCarts->inShoppingCarts;
            if($inShoppingCarts){
                $inShoppingCarts->delete();
                
            }
        }
        $shoppingCarts->delete();

    }
}
