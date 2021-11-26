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
            'name' => 'required|max:50|min:3',
            'email' => 'required|email',
            'photo_url' => 'nullable|file|image',
            'blocked' => 'required|numeric|min:0',
            'balance' => 'required|numeric|min:0',
            'max_debit' => 'required|numeric|min:0'
        ];
    }
}
