<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model {
    
    protected $fillable = [
        'plant_name',
        'plant_email',
        'plant_contact'
    ];
}