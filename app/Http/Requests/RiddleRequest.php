<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiddleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'タイトル' => 'required|string|max:100',
            '本文' => 'required|string',
            'ヒント' => 'required|string|max:200',
            '解答' => 'required|string|max:200',
            '解説' => 'required|string',
        ];
    }
}
