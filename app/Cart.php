<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $timestamps = false;
    protected $table = 'carts';
    protected $fillable = ['quantity','books_id','user_id'];
    public function users(){
    	return $this->belongsTo('App\User', 'id');
    }
    public function books(){
    	return $this->belongsTo('App\Books', 'id');
    }
}
