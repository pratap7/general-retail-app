<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Builder extends Model {

    use SoftDeletes;
    
    protected $fillable = [
        'party_name',
        'postal_address', 
        'owner_name',
        'village',
        'direct_customer_email',
        'taluka',
        'district',
        'state',
        'pincode',
        'owner_landline',
        'owner_mobile',
        'contact_person_landline',
        'contact_person_mobile',
        'project_category',
        'project_status',
        'total_consumption',
        'monthly_consumption',
        'site_destinations',
        'order_procured',
        'sales_rep_code',
        'non_trade',
        'credit_terms',
        'credit_limit_period',
        'is_dealing_other_firm',
        'other_firm_details',
        'gst_no',
        'pancard_no',
        'branch_head',
        'party_code',
        'factory_code',
        'dist_code',
        'frieght_code',
        'ac_ahmdbd',
        'letterhead_file',
        'pancard_file',
        'cancel_cheque_file',
        'gst_file',
        'cement_brand',
    ];
}