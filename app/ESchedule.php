<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ESchedule extends Model {

    protected $fillable = [
        'schedule_id',
        'doc_id',
        'room',
        'shift_start',
        'shift_end',
        'max_bookings',

    ];


    protected $primaryKey = 'schedule_id';


}
