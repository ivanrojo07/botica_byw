<?php namespace App;





use Illuminate\Database\Eloquent\Model;



class Category extends Model {



    protected $table = 'categories';

    protected $fillable = ['title', 'slug', 'description', 'background_image'];
    protected $hidden =[
    	'created_at',
    	'updated_at'

    ];

    public function products()

    {

        return $this->hasMany('App\Catalogo');

    }

}