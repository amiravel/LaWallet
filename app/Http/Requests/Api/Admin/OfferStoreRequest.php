<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OfferStoreRequest extends FormRequest
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
            'code' => ['required', Rule::unique('offers', 'code'), 'max:10', 'min:6'],
            'wallet_id' => ['required', Rule::exists('wallets', 'id')],
            'budget_amount' => ['required', 'integer', 'gt:0'],
            'amount_per_scan' => ['required', "lte:{$this->request->get('budget_amount')}", 'integer'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
            'max_scan' => ['required', 'integer', 'gt:0']
        ];
    }
}
