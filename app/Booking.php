<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

	protected $fillable = [
        'booking_id',
        'patient_id',
        'schedule_id',
        'number',
        'status'
        
       
    ];
        
    protected $primaryKey = 'booking_id';

}
