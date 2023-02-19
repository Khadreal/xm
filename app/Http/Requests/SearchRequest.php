<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends BaseRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'symbol' => 'required|exists:company_symbols',
            'email' => 'required|email',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date'
        ];
    }
}
