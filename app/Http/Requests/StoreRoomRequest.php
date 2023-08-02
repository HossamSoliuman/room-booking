<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
            'activated' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'city_id' => 'required|integer|exists:cities,id',
            'location' => 'required|string',
            'price_per_day' => 'required|integer',
            'number_of_beds' => 'required|integer',
            'images' => 'required|array|max:7|min:1',
            'images.*' => 'image|max:2048'
        ];
    }
}
