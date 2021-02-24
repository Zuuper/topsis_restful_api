<?php

namespace App\Http\Requests\Fintech;

use Illuminate\Foundation\Http\FormRequest;

class CreateFintechRequest extends FormRequest
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
            'nama' => 'required|unique:tb_fintech|min:5|max:45', 
            'alamat' => 'required|min:5|max:100',
            'no_telpon' => 'required|numeric'
        ];
    }
}
