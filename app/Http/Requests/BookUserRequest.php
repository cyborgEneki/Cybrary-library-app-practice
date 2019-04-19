<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUserRequest extends FormRequest
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
            'due_date' => 'required',
            'date_out' => 'required',
            'book_id' => 'required',
            'user_id' => 'required',
        ];
    }
}