<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomBookRequest extends FormRequest
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
			'user_id' => 'nullable|integer|exists:users,id',
			'room_id' => 'nullable|integer|exists:rooms,id',
			'check_in' => 'nullable|date',
			'check_out' => 'nullable|date',

        ];
    }
}
