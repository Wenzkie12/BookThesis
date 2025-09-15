<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'date_published' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
