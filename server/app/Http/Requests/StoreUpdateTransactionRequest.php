<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTransactionRequest extends FormRequest
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
            'vcard' => 'required|exists:vcards,phone_number',
            'date' => 'nullable|date',
            'datetime' => 'required|date|date_format:Y-m-d H:i:s',
            'type' => 'required|in:C,D',
            'value' => 'required|numeric|min:0',
            'old_balance' => 'required|numeric|min:0',
            'payment_type' => 'required|max:50|min:3',
            'payment_reference' => 'required|max:50|min:3',
            'pair_transaction' => 'nullable|exists:transactions,id',
            'pair_vcard' => 'nullable|exists:vcards,phone_number',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|max:50|min:3'
        ];
    }
}
