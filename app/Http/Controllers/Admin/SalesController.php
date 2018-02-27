<?php 
namespace App\Http\Controllers\Admin;





use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

use App\InShoppingCart;

use App\ShoppingCart;

use App\Product;



class SalesController extends Controller {



    public function __construct()

    {

        $this->middleware('auth');

    }



    public function getIndex(Request $request)

    {


       
        $filters = $request->all();




        //users

        $users = User::all();



        $user_selected = 0;



        $old_inputs = [

            'title' => '',

            'fecha1'   => '',

            'fecha2'   => ''

        ];





        if (isset($filters['user']) && $filters['user'] != '' && $filters['user'] != 'all') {



            $user_selected = $filters['user'];



            $sales = InShoppingCart::whereHas('shoppingcart', function ($query) use ($filters) {

                if ($filters['user'] == 0) {

                    $query->where('status', 'approve')->where('user_id', null);

                } else {

                    $query->where('status', 'approve')->where('user_id', $filters['user']);

                }





            });



        } else {



            $sales = InShoppingCart::whereHas('shoppingcart', function ($query) {

                $query->where('status', 'approve');

            });



        }



        if(isset($filters['title']) && $filters['title'] != ''){

            $sales = $sales->whereHas('product', function($query) use ($filters){

                $query->Search($filters['title']);

            });

            $old_inputs['title'] = $filters['title'];

        }

        
        
        if(isset($filters['fecha1']) && $filters['fecha1'] != '' || isset($filters['fecha2']) && $filters['fecha2'] != '' ){

            if(!isset($filters['fecha1']) && isset($filters['fecha2'])){
            $fecha2 = $filters['fecha2'];
            $sales = $sales->whereDate('created_at','<=', $fecha2);
        }

        if(isset($filters['fecha1']) && !isset($filters['fecha2'])){
            $fecha1 = $filters['fecha1'];
            $sales = $sales->whereDate('created_at','>=', $fecha1);
        }

         if(!isset($filters['fecha1']) && !isset($filters['fecha2'])){
           
        }

          if(isset($filters['fecha1']) && isset($filters['fecha2'])){

            $fecha1 = $filters['fecha1'];
            $fecha2 = $filters['fecha2'];
            
           

            $sales = $sales->whereDate('created_at','>=', $fecha1);
            $sales = $sales->whereDate('created_at','<=', $fecha2);
           
        }

            
          

           
           

            $old_inputs['fecha1'] = $filters['fecha1'];
            $old_inputs['fecha2'] = $filters['fecha2'];

        }



        $sales = $sales->with(['shoppingcart', 'product']);

        

        $count_products = $sales->count();



        $sales = $sales->orderBy('created_at', 'desc')->paginate(30);

        

    
        return view('admin.sales.index', ['sales'=>$sales, 'count_products'=>$count_products, 'users'=>$users, 'user_selected'=>$user_selected])->with($old_inputs);

    }

}