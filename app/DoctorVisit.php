<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorVisit extends Model {

    protected $fillable = [
        'booking_id',
        'patient_id',
        'doctor_id',
        'visit_date',
        'family_history' ,
        'diagnosis_notes' ,
        'prescription'
    ];
}
