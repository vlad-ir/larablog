<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'title' => 'required|unique:posts|min:3|max:120',
            'intro' => 'required|min:100|max:200',
            'text' => 'required|min:100',
            'image' => 'mimes:jpeg,png|max:5000',
        ];
        if ($this->isMethod('PATCH')) {
            $rules['title'] = 'required|min:3|max:120';
        }
        return $rules;
    }
}
