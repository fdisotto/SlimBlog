<?php

class Users extends Illuminate\Database\Eloquent\Model {
    protected $table = "users";

    public static function get_author($id) {
        $user = Users::find($id);
        return $user->username;
    }

    public static function get_id($user) {
        $user = Users::where('username', '=', $user)->first();
        return $user->id;
    }
}