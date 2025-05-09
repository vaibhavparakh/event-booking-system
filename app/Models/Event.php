<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'from_date_time', 'to_date_time', 'venue',
        'location_url', 'organised_by', 'duration_in_hrs', 'cover_image_url',
        'entry_fee', 'capacity', 'type', 'status', 'category', 'language', 'mode',
    ];

    public function registration()
    {
        return $this->hasMany(Registration::class);
    }
}
