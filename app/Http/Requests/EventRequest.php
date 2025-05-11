<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Set to false if you want to restrict access
    }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'from_date_time'   => 'required|date',
            'to_date_time'     => 'required|date|after:from_date_time',
            'venue'            => 'required|string|max:255',
            'location_url'     => 'required|url|max:500',
            'organised_by'     => 'required|string|max:255',
            'duration_in_hrs'  => 'required|numeric|min:0.5',
            'cover_image_url'  => 'required|url|max:500',
            'entry_fee'        => 'required|numeric|min:0',
            'capacity'         => 'required|integer|min:1',
            'type'             => 'required|in:free,paid',
            'status'           => 'required|in:draft,published',
            'category'         => 'required|in:conference,workshop,webinar,concert',
            'mode'             => 'required|in:online,offline',
            'country'          => 'required|string',
            'id'               => 'integer|min:1',
        ];
    }
}
