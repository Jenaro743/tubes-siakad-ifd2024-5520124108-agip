<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MahasiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array($this->user()?->role, ['admin', 'mahasiswa'], true);
    }

    public function rules(): array
    {
        $mahasiswa = $this->route('mahasiswa') ?? $this->user()?->mahasiswa;
        $isAdminRoute = str_starts_with((string) $this->route()?->getName(), 'admin.');

        return [
            'name' => [$isAdminRoute ? 'required' : 'sometimes', 'string', 'max:255'],
            'email' => [$isAdminRoute ? 'required' : 'sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($mahasiswa?->user_id)],
            'password' => [$this->isMethod('post') && $isAdminRoute ? 'required' : 'nullable', 'string', 'min:8'],
            'npm' => [$isAdminRoute ? 'required' : 'sometimes', 'string', 'max:30', Rule::unique('mahasiswas', 'npm')->ignore($mahasiswa?->id)],
            'nama_mahasiswa' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'integer', 'min:1', 'max:14'],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'string', 'max:30'],
            'foto' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
