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
            'riddle.title' => 'required|string|max:100',
            'riddle.text' => 'required|string',
            'riddle.image'=> 'file|image|mimes:png,jpeg',
            'riddle.hint' => 'required|string|max:200',
            'riddle.answer' => 'required|string|max:200|regex:/^[^\x01-\x7E\x{FF61}-\x{FF9F}]+$/u',
            'riddle.commentary' => 'required|string',
        ];
    }
}
