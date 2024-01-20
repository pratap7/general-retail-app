<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    
    use SoftDeletes;

    protected $fillable = [
        'builder_id',
        'cement_brand',
        'plant_id',
        'packing_type',
        'cement_type',
        'bag_price',
        'quantity_type_kg',
        'total_amount',
        'payment_detail',
        'cheque_no',
        'cheque_date',
        'bank',
        'order_no',
        'billing_address',
        'delivery_address',
        'site_address',
        'order_schedule',
        'site_contact',
        'rate_per_mt',
        'site_taluka',
        'site_district'
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
    public function plant() {
        return $this->belongsTo('App\Plant');
    }
}