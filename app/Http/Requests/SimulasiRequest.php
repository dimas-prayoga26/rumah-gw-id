<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimulasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge($this->json()->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lebar' => 'required|numeric|max_digits:2',
            'panjang' => 'required|numeric|max_digits:2',
            'hook' => 'required|boolean|max_digits:2',
            'lantai' => 'required|numeric|max_digits:2',
        ];
    }

    public function messages()
    {
        return [
            'lebar.required' => 'Lebar tidak boleh kosong',
            'panjang.required' => 'Panjang tidak boleh kosong',
            'hook.required' => 'Hook tidak boleh kosong',
            'lantai.required' => 'Lantai tidak boleh kosong',
            'lebar.numeric' => 'Lebar harus berupa angka',
            'panjang.numeric' => 'Panjang harus berupa angka',
            'hook.numeric' => 'Hook harus berupa angka',
            'lantai.numeric' => 'Lantai harus berupa angka',
            'lebar.max_digits' => 'Lebar maksimal 2 digit',
            'panjang.max_digits' => 'Panjang maksimal 2 digit',
            'hook.max_digits' => 'Hook maksimal 2 digit',
            'lantai.max_digits' => 'Lantai maksimal 2 digit',
        ];
    }
}
