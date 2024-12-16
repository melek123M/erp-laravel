<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

class CreateFactureRequest extends FormRequest
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
        return Invoice::rules();
    }
    public function messages(): array
    {
        return Invoice::messages();
    }
}
