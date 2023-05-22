<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Application\DTOs\User\UpdateUserDataRequest;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class UpdateRequest extends FormRequest
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
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|max:320'
        ];
    }

    protected function dataClass(): string
    {
        return UpdateUserDataRequest::class;
    }
}
