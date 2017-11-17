<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupPayment extends Model {

	//
    protected $fillable = [

        'pid',
        'scheduleId',
        'patientId',
        'date',
        'amount',

    ];

    protected $primaryKey = 'pid';

}
