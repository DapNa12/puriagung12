<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKegiatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kegiatan' => [
                'required', 'string', 'max:255',
                Rule::unique('kegiatan')->where(fn ($q) => $q->where('tanggal', $this->tanggal)),
            ],
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
            'waktu' => 'nullable|date_format:H:i',
            'tempat' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'status' => 'required|in:akan_datang,selesai,dibatalkan',
        ];
    }
}
