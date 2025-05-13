<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    // use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'from_date_time', 'to_date_time', 'venue',
        'location_url', 'organised_by', 'duration_in_hrs', 'cover_image_url',
        'entry_fee', 'capacity', 'type', 'status', 'category', 'language', 'mode', 'country'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
