<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() == 'PUT') {
            return [
                'user_id' => ['integer'],
                'title' => ['required', 'max:250'],
                'content' => ['max:2500'],
                'category' => ['in:todo,reminder,account,other'],
            ];
        } elseif ($this->method() == 'PATCH') {
            return [
                'user_id' => ['sometimes', 'integer'],
                'title' => ['sometimes', 'required', 'max:250'],
                'content' => ['sometimes', 'max:2500'],
                'category' => ['sometimes', 'in:todo,reminder,account,other'],
            ];
        }
    }
}