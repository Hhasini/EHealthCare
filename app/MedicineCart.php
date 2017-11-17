<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineCart extends Model {

    protected $fillable = [
        'medicine_id',
        'amount',
        'price'
    ];


}
