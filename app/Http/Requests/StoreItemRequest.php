<?php

namespace App\Http\Requests;

use App\Models\Item;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Auth di-skip untuk MVP, jadi semua pengunjung boleh memposting.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:5000'],
            'category' => ['nullable', 'string', Rule::in(Item::CATEGORIES)],
            'location' => ['nullable', 'string', 'max:255'],
            'item_date' => ['nullable', 'date', 'before_or_equal:today'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'reporter_name' => ['nullable', 'string', 'max:100'],
        ];
    }

    /**
     * Pesan validasi dalam Bahasa Indonesia.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Nama atau judul barang wajib diisi.',
            'title.min' => 'Nama barang minimal :min karakter.',
            'title.max' => 'Nama barang maksimal :max karakter.',
            'description.required' => 'Deskripsi barang wajib diisi.',
            'description.min' => 'Deskripsi barang minimal :min karakter.',
            'description.max' => 'Deskripsi barang maksimal :max karakter.',
            'category.in' => 'Kategori yang dipilih tidak valid.',
            'location.max' => 'Lokasi maksimal :max karakter.',
            'item_date.date' => 'Tanggal tidak valid.',
            'item_date.before_or_equal' => 'Tanggal tidak boleh melebihi hari ini.',
            'photo.image' => 'File foto harus berupa gambar.',
            'photo.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'photo.max' => 'Ukuran foto maksimal 2 MB.',
            'reporter_name.max' => 'Nama pelapor maksimal :max karakter.',
        ];
    }

    /**
     * Nama atribut yang lebih ramah untuk pesan error.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'nama barang',
            'description' => 'deskripsi barang',
            'category' => 'kategori',
            'location' => 'lokasi',
            'item_date' => 'tanggal',
            'photo' => 'foto',
            'reporter_name' => 'nama pelapor',
        ];
    }
}
