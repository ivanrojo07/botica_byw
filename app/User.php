<?php



namespace App;





use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Direccion;



class User extends Authenticatable {



    use Notifiable;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'password',

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];



    public function direccions()

    {

        return $this->hasMany('App\Direccion');

    }



    public function favorite_products()

    {

        return $this->belongsToMany('App\Catalogo', 'user_favorite_products', 'user_id', 'catalogo_id');

    }



}

