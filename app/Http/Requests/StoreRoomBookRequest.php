<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomBookRequest extends FormRequest
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
			'user_id' => 'required|integer|exists:users,id',
			'room_id' => 'required|integer|exists:rooms,id',
			'check_in' => 'required|date',
			'check_out' => 'required|date',

        ];
    }
}