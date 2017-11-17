<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FullBloodCount extends Model {

	//
    protected $fillable = [

        'id',
        'visit_id',
        'patientSchId',
        'enterDate',
        'wbc',
        'rbc',
        'hgb',
        'platelet',
        'neut',
        'lymph',
        'mono',
        'eos',
        'baso',

    ];

    protected $primaryKey = 'id';
}
