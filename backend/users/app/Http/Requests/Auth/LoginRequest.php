<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|string|max:320',
            'password' => 'required|string|max:255',
            'password_confirm' => 'required|same:password|string|max:255',
            'scope' => 'sometimes|string|in:influencer,admin',
        ];
    }
}
