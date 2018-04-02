<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $table = 'orders';
    protected $fillable = ['order_status','user_id','books_id','quantity'];
    /*public function customers(){
    	return $this->belongsTo('App\Customer', 'id');
    }*/
   /* public function books(){
    	return $this->belongsTo('App\Book', 'id');
    }*/
    public function books(){
        return $this->belongsTo('App\Books', 'id');
    }

  //  public function order_details()
    //{
      //  return $this->hasMany('App\OrderDetails');
    //}
    public function users(){
        return $this->belongsTo('App\User', 'id');
    }
}
