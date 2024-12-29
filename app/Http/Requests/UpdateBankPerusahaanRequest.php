<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankPerusahaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_rekening' => 'required|string|max:255',  // Pastikan ada validasi untuk nama rekening
            'bank_id' => 'nullable',
            'nomor_rekening' => 'nullable',
        ];
    }
    
}
