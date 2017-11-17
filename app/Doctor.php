<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {

    protected $fillable = [
    'doctor_id',
    'name',
    'email',
    'specialty',
    'nic',
    'address',
    'phone'
];
}
