<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => 'required|min:5|unique:news,title,'.@$this->news->id,
            'description' => 'required|min:5',
            'meta_title' => 'required|min:5',
            'meta_description' => 'required|min:5',
            'meta_keywords' => 'required|min:5'
        ];
    }
}
