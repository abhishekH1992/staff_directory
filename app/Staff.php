<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

  	protected $fillable = ['fname', 'lname', 'department', 'profile', 'image', 'updated_at'];

  	function departments(){
  		return $this->belongsTo(Department::class, 'department', 'id');
  	}
}
