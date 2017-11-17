<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {

	protected $fillable = [
        'id',
        'member_id',
        'name',
        'dob',
        'email',
        'nic',
        'address',
        'phone',
        'sex'
       
    ];
        
    protected $primaryKey = 'id';

}
