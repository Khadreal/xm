<?php
/**
 * Create base request for form request to avoid redirection for failed validation
 *
 *
 */
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( response()->json( [
            'status' => 'error',
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors()->all()
        ], 422 ) );
    }
}
