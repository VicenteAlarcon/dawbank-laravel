<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuentaRequest extends FormRequest
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
               'nombre' => ['required', 'string', 'min:2', 'max:50'],
            'apellidos' => ['required', 'string', 'min:2', 'max:100'],
            'dni' => ['required', 'string', 'regex:/^[0-9]{8}[A-Z]$/'],
        ];
    }
     public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'apellidos.required' => 'Los apellidos son obligatorios',
            'dni.required' => 'El DNI es obligatorio',
            'dni.regex' => 'El DNI debe tener 8 números y una letra mayúscula',
        ];
    }
}
