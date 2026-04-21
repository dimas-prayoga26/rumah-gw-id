<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
            'nama' => 'prohibited',
            'kategori' => 'prohibited',
            'harga' => 'required|numeric|min:0',
            'rasio' => 'required|numeric|min:0',
            'item' => 'prohibited',
        ];
    }

    public function messages(): array
    {
        return [
            'rasio.required' => 'Rasio harus diisi.',
            'rasio.numeric' => 'Rasio harus berupa angka.',
            'rasio.min' => 'Rasio tidak boleh kurang dari 0.',
            'item.prohibited' => 'Item tidak boleh diubah.',
            'nama.prohibited' => 'Nama tidak boleh diubah.',
            'kategori.prohibited' => 'Kategori tidak boleh diubah.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh kurang dari 0.',
        ];
    }
}
