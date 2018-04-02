<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
	protected $timestamps = false;
    protected $table = 'admins';
    protected $fillable = ['admin_password'];
    public function users(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
