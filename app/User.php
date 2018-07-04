<?php



namespace App;





use App\Direccion;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable {



    use Notifiable, softDeletes;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'password',

    ];

    protected $dates = ['deleted_at'];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'remember_token', 'created_at', 'updated_at'

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

