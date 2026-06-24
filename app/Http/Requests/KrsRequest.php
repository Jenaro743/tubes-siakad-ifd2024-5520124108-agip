<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KrsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'mahasiswa';
    }

    public function rules(): array
    {
        $mahasiswaId = $this->user()?->mahasiswa?->id;

        return [
            'jadwal_id' => [
                'required',
                'exists:jadwals,id',
                Rule::unique('krs', 'jadwal_id')->where('mahasiswa_id', $mahasiswaId),
            ],
        ];
    }

    public function messages(): array
    {
        return ['jadwal_id.unique' => 'Mata kuliah ini sudah ada di KRS Anda.'];
    }
}
