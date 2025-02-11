<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembayaranRequest extends FormRequest
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
            'tagihan_id' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric',
        ];
    }

    /**
 * Prepare the data for validation.
 */
protected function prepareForValidation(): void
{
    $this->merge([
        'jumlah_bayar' => str_replace('.', '', $this->jumlah_bayar),
    ]);
}
}
