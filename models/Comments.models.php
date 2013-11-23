<?php
class Comments extends Illuminate\Database\Eloquent\Model {
    protected $table = "comments";

    public function post() {
        return $this->belongsTo('Posts');
    }
}