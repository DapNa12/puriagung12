<?php

namespace App\Http\Requests;

use App\Models\Umkm;
use Illuminate\Foundation\Http\FormRequest;

class StoreUmkmRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:'.implode(',', Umkm::$kategoriList),
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nama_pemilik' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'no_hp' => 'required|string|max:20',
            'jam_operasional' => 'nullable|string|max:100',
            'maps_link' => 'nullable|url|max:500',
        ];
    }
}
