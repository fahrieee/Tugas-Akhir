<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Str;

class StoreHutangRequest extends FormRequest
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
            'nama' => 'required',
            'jumlah' => 'required|numeric',
            'biaya_id' => 'nullable|exists:hutangs,id'
        ];
    }

    /**
 * Prepare the data for validation.
 */
protected function prepareForValidation(): void
{
    $this->merge([
        'jumlah' => str_replace('.', '', $this->jumlah),
    ]);
}
}
