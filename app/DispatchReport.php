<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispatchReport extends Model {
    
    protected $fillable = [
        'brand', 
        'type', 
        'ref_doc_no', 
        'del_date', 
        'quantity', 
        'invoice_no', 
        's_plan_no', 
        'transport_name', 
        'date_tmg', 
        'brand', 
        'price', 
        'order_no',
        'party_code', 
        'truck_no', 
        'location', 
        'party_name', 
        'invoice_amount',
        'company',
        'tax_retail_inv'

    ];
}