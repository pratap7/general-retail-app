<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    
    protected $fillable = [
        'builder_id',
        'order_id',
        'payment_mode',
        'amount',
        'cheque_rtgs_no',
        'account_no',
        'bank_name',
        'ifsc_code',
        'branch_name',
        'remarks',
        'party_remarks',
        'account_holder',
        'invoice_reference',
        'dispatch_id'
    ];

    /**
     * Get the Builder that owns the Order.
     */
    public function builder() {
        return $this->belongsTo('App\Builder');
    }

    /**
     * Get the Plant that owns the Order.
     */
    public function order() {
        return $this->belongsTo('App\Order');
    }

    /**
     * Get the Plant that owns the Order.
     */
    public function dispatch() {
        return $this->hasOne('App\DispatchReport','id','dispatch_id');
    }
}