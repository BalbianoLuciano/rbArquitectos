<?php

namespace App\Http\Requests\Authors;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'biography' => 'required|string',
            'date_of_birth' => 'required|date', // Añadido - valida una fecha
            'place_of_birth' => 'required|string|max:255', // Añadido - valida una cadena
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.exists' => 'The associated user does not exist.',
            'name.required' => 'The name field is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'biography.required' => 'The biography field is required.',
            'date_of_birth.required' => 'The date of birth is required.', // Mensaje de error añadido
            'date_of_birth.date' => 'The date of birth is not a valid date.', // Mensaje de error añadido
            'place_of_birth.required' => 'The place of birth is required.', // Mensaje de error añadido
            'place_of_birth.max' => 'The place of birth may not be greater than 255 characters.', // Mensaje de error añadido
        ];
    }
}
