<?php

declare(strict_types=1);

namespace App\Domains\Auth\Requests;

use App\Domains\Auth\DTO\Requests\UserInfoData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class UpdateInfoRequest extends FormRequest
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
            'email' => 'email',
        ];
    }

    protected function dataClass(): string
    {
        return UserInfoData::class;
    }
}
