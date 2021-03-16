<?php

namespace App\Http\Requests\TopUp;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopUpRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'id_nasabah' => 'required',
            'jumlah_topup' => 'required|numeric',
        ];
    }
}
