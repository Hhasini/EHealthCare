<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class EC_DocRates extends Model {

    protected $fillable = [
        'rid',
        'doc_id',
        'rate'

    ];


    protected $primaryKey = 'rid';
}
