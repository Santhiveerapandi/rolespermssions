<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoUpdateRequest extends FormRequest
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
        return $rules= [
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10|max:5000'
        ];
    }

    public function messages()
    {
        return $msg  = [
            'title.required' => 'Todo is Required',
            'title.min'=> 'Todo Must be atleast 5 characters',
            'title.max'=> 'Todo allowed only 255 characters',
            'description.required' => 'Description is Required',
            'description.min'=> 'Description Must be atleast 10 characters',
            'description.max'=> 'Description allowed only 5000 characters'
        ];
    }
}
