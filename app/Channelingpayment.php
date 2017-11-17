<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Channelingpayment extends Model {

	protected $fillable = [
        'payment_id',
        'booking_id',
        'transaction_id',
        'currency_code',
        'payment_status'
        
       
    ];
        
    protected $primaryKey = 'payment_id';


}
