<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'phone' => ['required', 'digits:10', Rule::unique('guests')->ignore($this->route('guest'))],
            'side' => ['required', 'in:NiiPro,Appier-Sign'],
            'gender' => ['required', 'in:male,female'],
            'guest_id' => ['sometimes', 'nullable', Rule::exists('guests', 'id')]
        ];
    }

    public function messages()
    {
        return [
            'phone.unique' => 'guest already added'
        ];
    }
}
