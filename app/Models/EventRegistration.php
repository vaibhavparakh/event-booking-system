<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = ['attendee_id', 'event_id'];

    public function attendees()
    {
        return $this->belongsTo(Attendee::class, 'attendee_id', 'id');
    }
    
    public function events()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
