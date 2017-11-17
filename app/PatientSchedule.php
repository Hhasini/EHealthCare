<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientSchedule extends Model {

	//

    protected $fillable = [

        'id',
        'bookingID',
        'scheduleId',
        'status',

    ];

    protected $primaryKey = 'id';

}
