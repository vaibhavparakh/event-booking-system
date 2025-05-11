<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Log;

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
        try {
            //code...
            return [
                'event_id'      => 'required|integer|min:1',
                'attendee_id'   => 'required|integer|min:1',
            ];
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function messages()
    {
        return [
            'event_id.required' => 'Invalid Event ID!',
            'attendee_id.required' => 'Invalid Attendee ID!',
        ];
    }

    public function response(array $errors)
    {
        return API::setStatusCode(422)->respondWithError($errors);
    // yours might look more like this ->  return new JsonResponse($errors, 422);
    }

    public function forbiddenResponse()
    {
        return API::respondForbidden();
    // yours might look more like this  -> return new JsonResponse('Forbidden', 403);
    }
}
