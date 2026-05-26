<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'species_name',
        'location',
        'latitude',
        'longitude',
        'status',
        'description',
        'image',
        'image_data',
        'image_mime',
        'user_id'
    ];

    /**
     * Prevent large binary data from being included in JSON/array output.
     */
    protected $hidden = [
        'image_data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}