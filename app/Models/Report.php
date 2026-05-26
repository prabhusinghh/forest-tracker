<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'species_name',
        'location',
        'status',
        'description',
        'image',
        'user_id'
    ];
}