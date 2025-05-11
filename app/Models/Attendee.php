<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = [
        'name', 'mobile_number', 'email', 'date_of_birth', 'gender', 'occupation', 'city', 'state', 'age'
    ];

    public function event_registration()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
