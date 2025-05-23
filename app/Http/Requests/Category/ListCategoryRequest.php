<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class ListCategoryRequest extends FormRequest
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
        return [
            "per_page" => ["sometimes", "integer","min:1"],
            "page" => ["sometimes", "integer","min:1"],
            "search" => ["sometimes", "string", "max:255"],
            "sort_by" => ["sometimes", "string", "in:name,created_at,type"],
            "sort_order" => ["sometimes", "in:asc,desc"],
        ];
    }
}
