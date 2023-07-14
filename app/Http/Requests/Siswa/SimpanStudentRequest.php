<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;

class SimpanStudentRequest extends FormRequest
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
     * Dapatkan aturan validasi yang diterapkan pada permintaan ini.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:6', 'max:255'],
            'email' => ['required', 'email', 'unique:students', 'max:255'],
            'phone' => ['required', 'min:6'],
        ];
    }
}
