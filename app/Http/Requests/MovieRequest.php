<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title' => 'required',
            'summary' => 'required',
            'duration' => 'required',
            'image_path' => '',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo titulo é obrigatório',
            'summary.required' => 'O campo sumário é obrigatório',
            'duration.required' => 'O campo duração é obrigatório',
            'category_id.required' => 'O campo categoria é obrigatório'
        ];
    }
}
