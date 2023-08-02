<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
			'activated' => 'nullable|integer',
			'title' => 'nullable|string',
			'description' => 'nullable|string',
			'city_id' => 'nullable|integer|exists:cities,id',
			'location' => 'nullable|string',
			'user_id' => 'nullable|integer|exists:users,id',
			'price_per_day' => 'nullable|integer',
			'number_of_beds' => 'nullable|integer',

        ];
    }
}
