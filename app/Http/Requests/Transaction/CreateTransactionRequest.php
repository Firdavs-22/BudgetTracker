<?php

namespace App\Http\Requests\Transaction;

use App\Rules\CategoryExist;
use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
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
            "amount" => ["required", "numeric", "min:1"],
            "description" => ["sometimes", "string", "max:255"],
            "category_id" => ["required", "integer", new CategoryExist],
        ];
    }
}
