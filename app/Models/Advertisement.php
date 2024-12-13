<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $guarded = [];


    public function category(){
        return $this -> belongsTo(Category::class);
    }
    public function categories(){
        return $this -> belongsToMany(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}