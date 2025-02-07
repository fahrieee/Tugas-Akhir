<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMandorRequest extends FormRequest
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
            'pengawas_id' => 'nullable',
            'nama' => 'required',
            'hutang_id' => 'required|exists:hutangs,id',
            'kategori' => 'required',
            'periode' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
            
        ];
    }
}
