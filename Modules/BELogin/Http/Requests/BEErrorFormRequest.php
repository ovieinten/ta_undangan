<?php

namespace Modules\BELogin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BEErrorFormRequest extends FormRequest
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
            'title' => 'required|min:5',
            'desc' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Error!',
            'title.min' => 'Error!',
            'desc.required' => 'Login Gagal'
        ];
    }
}
