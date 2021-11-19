<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["name","message","parent_id"];

    public function sub_comments(){
        return $this->hasMany('App\Comment', 'parent_id', 'id')->orderBy('id','DESC');
    }
}
