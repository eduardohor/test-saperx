<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|min:5|max:100|string',
            'email' => 'required|email|unique:contacts',
            'date_of_birth' => 'required|date',
            'cpf' => 'required|min:11|max:11',
            'telephone' => 'required'
        ];
    }
}
