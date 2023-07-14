<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\Requests;
use Illuminate\Validation\Rule;

/**
 * @property mixed id
 * @property mixed siswa
 */
class UpdateStudentRequest extends Requests
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat permintaan ini.
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
            'nama' => ['required', 'min:6', 'max:255'],
            'email' => ['required', 'email', Rule::unique('siswa')->ignore($this->siswa->id), 'max:255'],
            'telepon' => ['required', 'min:6'],
        ];
    }
}
