<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FastingBloodCount extends Model {

	//
    protected $fillable = [

        'id',
        'visit_id',
        'patientSchId',
        'enterDate',
        'fbs',

    ];

    protected $primaryKey = 'id';

}
