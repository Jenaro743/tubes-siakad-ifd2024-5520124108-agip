<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DosenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->role === 'admin';
    }

    public function rules(): array
    {
        $id = $this->route('dosen')?->id;

        return [
            'nidn' => ['required', 'string', 'max:30', Rule::unique('dosens', 'nidn')->ignore($id)],
            'nama_dosen' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('dosens', 'email')->ignore($id)],
            'no_telp' => ['required', 'string', 'max:30'],
            'alamat' => ['required', 'string'],
        ];
    }
}
