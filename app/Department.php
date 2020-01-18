<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

  	protected $fillable = ['name', 'updated_at'];

  	function staff(){
  		return $this->hasMany('App\Staff', 'department');
  	}
}