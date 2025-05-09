<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'mobile_number' => 'required|digits_between:10,15',
            'email'         => 'required|email|max:255',
            'gender'        => 'required|in:male,female,other',
            'occupation'    => 'required|string|max:255',
            'city'          => 'required|string|max:255',
            'state'         => 'required|string|max:255',
            'age'           => 'required|integer|min:1|max:150',
            'event_id'      => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'mobile_number.required' => 'Mobile Number is required!',
            'email.required' => 'Email is required!',
            'gender.required' => 'Gener is required!',
            'occupation.required' => 'Occupation is required!',
            'city.required' => 'City is required!',
            'state.required' => 'State is required!',
            'age.required' => 'Age is required!',
            'event_id.required' => 'Invalid Event ID!',
            'name.string' => 'Name must be a string!',
            'mobile_number.digits_between' => 'Mobile Number must be between 10 and 15 digits!',
            'email.email' => 'Email must be a valid email address!',
        ];
    }
}
