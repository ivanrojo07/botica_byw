<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusTracking extends Model
{
     protected $table = 'status_tracking';
     protected $fillable=['tracking_id',
                          'fecha',
                          'hora',
                          'status'
                      ];

     public function tracking(){

     	return $this->belongsTo('App\Tracking','tracking_id');
     }
}
