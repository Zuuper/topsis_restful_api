<?php

namespace App\Http\Requests\Nasabah;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordNasabahRequest extends FormRequest
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
            'password_baru' => 'required',
            'password_lama' => 'required'
        ];
    }
}
