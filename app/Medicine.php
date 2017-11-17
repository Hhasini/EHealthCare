<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model {

    protected $fillable = [
        'medicine_id',
        'medicine_name',
        'description',
        'manufacturer',
        'price'


    ];

    protected $primaryKey = 'medicine_id';





}
