<?php

class Posts extends Illuminate\Database\Eloquent\Model {
    protected $table = "posts";
    public $timestamp = false;

    protected $fillable = ['title','text'];

    public function comments() {
        return $this->hasMany('Comments');
    }
}
