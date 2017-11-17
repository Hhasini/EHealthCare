<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckupShedule extends Model {

	//
    protected $fillable = [

        'id',
        'resourceId',
        'timeSlot',
        'date',
        'count',
        'status',

    ];

    protected $primaryKey = 'id';

}
