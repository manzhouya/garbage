<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'style'];
  
  	public function garbages()
    {
        return $this->hasMany(Garbage::class);
    }
}
