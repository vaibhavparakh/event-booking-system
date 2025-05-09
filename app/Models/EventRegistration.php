<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = ['attendee_id', 'event_id'];

    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
