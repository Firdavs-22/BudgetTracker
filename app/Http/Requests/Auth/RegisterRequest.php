<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name" => ["required", "string", "min:1", "max:255"],
            "username" => ["required", "string", "min:3", "max:15", "regex:/^\S*$/U",
                function ($attribute, $value, $fail) {
                    $exists = User::whereRaw("username like ?",[$value])->exists();
                    if ($exists) {
                        $fail("The username has already been taken.");
                    }
                }],
            "email" => ["required", "string", "email", "max:255", "unique:users,email"],
            "password" => ["required", "string", "min:8", "confirmed"],
            "phone" => ["required", "numeric", "digits_between:7,15"],
            "remember" => ["required", "boolean"],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "username" => trim($this->username),
        ]);
    }
}
