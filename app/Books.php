<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //
    public $timestamps = false;
    protected $table = 'books';
    protected $fillable = ['title', 'author', 'publisher', 'isbn',
       'price', 'stock', 'genre', 'book_img','description'];
    public function orders(){
        return $this->hasMany('App\Orders');
    }
    //public function order_details(){
      //  return $this->hasMany('App\OrderDetails');
    //}
    public function carts(){
        return $this->hasMany('App\Cart');
    }
}
