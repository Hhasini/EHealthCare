<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelECschedules extends Model {

    protected $fillable = [
        'id',
        'schedule_id',
        'reason_to_cancel',
        'doc_id',
        'room',
        'shift_start',
        'shift_end',
        'max_bookings',


    ];

    protected $primaryKey = 'id';

}
