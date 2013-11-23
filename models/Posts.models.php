<?php

class Posts extends Illuminate\Database\Eloquent\Model {
    protected $table = "posts";
    public $timestamp = false;

    public function comments() {
        return $this->hasMany('Comments');
    }
}