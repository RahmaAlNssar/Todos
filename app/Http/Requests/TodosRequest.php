<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodosRequest extends FormRequest
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
        if (request()->route()->getActionMethod() == 'store') {
        return [
            'todo'=>'required|string',
            'completed'=>'required',
            'userId'=>'required|integer'
        ];
     }
     if (request()->route()->getActionMethod() == 'update') {
        return [
            'completed'=>'required',
           
        ];
     }
    }
}
