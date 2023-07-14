<?php

namespace App\Http\Requests\MataPelajaran;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMataPelajaranRequest extends FormRequest
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
            'nama' => ['required', 'max:255', Rule::unique('mata_pelajaran')->ignore($this->mata_pelajaran->id)],
            'deskripsi' => ['string'],
        ];
    }
}
