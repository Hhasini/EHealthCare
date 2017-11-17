<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organvisit extends Model {

    protected $table = 'organvisits';
    protected $fillable = ['nic', 'id', 'fname', 'age', 'bloodgroup'];

    //
}
