<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateVCardsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'phone_number' => 'required|min:9|max:9',
            'password' => 'required|min:4',
            'confirmation_code' => 'required|min:4|max:4',
            'blocked' => 'required|boolean',
            'name' => 'required|max:50|min:3',
            'email' => 'required|email',
            'photo_url' => 'nullable|string',
            'balance' => 'required|numeric|min:0',
            'max_debit' => 'required|numeric|min:0'
        ];
    }
}
