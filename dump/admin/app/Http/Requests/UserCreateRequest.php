<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 * )
 */
class UserCreateRequest extends FormRequest
{
    /**
     * @OA\Property(
     *   title="first_name"
     * )
     *
     * @var string
     */
    public string $first_name;

    /**
     * @OA\Property(
     *   title="last_name"
     * )
     *
     * @var string
     */
    public string $last_name;

    /**
     * @OA\Property(
     *   title="email"
     * )
     *
     * @var string
     */
    public string $email;

    /**
     * @OA\Property(
     *   title="role_id"
     * )
     *
     * @var int
     */
    public int $role_id;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        return Gate::allows('edit', 'users');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ];
    }
}
