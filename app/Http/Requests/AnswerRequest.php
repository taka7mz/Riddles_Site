<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_ans' => 'string|max:200|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
        ];
    }
}
