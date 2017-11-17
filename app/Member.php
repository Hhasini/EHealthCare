<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

    protected $fillable = [
        'member_id',
        'name',
        'email',
        'nic',
        'address',
        'phone'
    ];


}
