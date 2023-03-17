<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Data\Requests\Auth\PasswordData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class UpdatePasswordRequest extends FormRequest
{
    use WithData;

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
            'password' => 'required|string',
            'password_confirm' => 'required|same:password|string',
        ];
    }

    protected function dataClass(): string
    {
        return PasswordData::class;
    }
}
