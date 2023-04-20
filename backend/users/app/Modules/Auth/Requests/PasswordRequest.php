<?php

declare(strict_types=1);

namespace App\Modules\Auth\Requests;

use App\Modules\Auth\DTO\PasswordData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class PasswordRequest extends FormRequest
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
