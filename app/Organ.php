<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organ extends Model {

    protected $table = 'organs';
    protected $fillable = ['fname', 'id', 'age', 'gender', 'bloodgroup', 'part', 'address', 'email', 'phone', 'image'];

}
