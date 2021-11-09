<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apllication extends Model
{
    //
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	protected $fillable = [
        'name', 'topic', 'text', 'email', 'path', 'user_id',
    ];
	
	public function access_check( $rules )  // Проверка прав пользователя.
    {
		if( Gate::denies( $rules , new Apllication ) )
		{ return abort(403); }
	}
}
