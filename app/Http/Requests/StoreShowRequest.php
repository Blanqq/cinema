<?php

namespace App\Http\Requests;

use GuzzleHttp\Middleware;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // true becouse auth through routemiddleware, to not duplicate auth
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie' => ['required'],
            'room' => ['required'],
            'starts_at_date' => ['required'],
            'starts_at_time' => ['required'],
            'ends_at_date' => ['required', 'after_or_equal:starts_at_date'],
            'ends_at_time' => ['required', 'after:starts_at_time']
        ];
    }
}
