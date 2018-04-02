<?php namespace App\Services;





use Illuminate\Support\Facades\Auth;



class FavoriteProduct {



    public function isFavorite($product_id)

    {



        $user = Auth::user();



        $result = $user->favorite_products()->where('catalogo_id', $product_id)->get();



        return count($result);





    }

}