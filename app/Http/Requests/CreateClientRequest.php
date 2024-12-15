<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateClientRequest extends FormRequest
{
    /**
     * Determine if the Composition is authorized to make this request.
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
        return Client::rules();
    }
    public function messages(): array
    {
        return Client::messages();
    }
    // protected function failedValidation(Validator $validator)
    // {
    //     $errors = $validator->errors()->all();
    //     throw new HttpResponseException(response()->json([
    //         'message' => $errors[0],
    //     ], 422));
    // }
}
