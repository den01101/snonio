<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enum\ShapeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShapeRequest extends FormRequest
{
    private const string RULE = 'required|numeric|min:0';

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'type' => ['required', Rule::in(ShapeEnum::cases())],
        ];

        foreach ($this->type()->parameters() as $param) {
            $rules[$param] = self::RULE;
        }

        return $rules;
    }

    public function type(): ShapeEnum
    {
        return ShapeEnum::from($this->input('type'));
    }

    public function parameters(): array
    {
        return array_map(
            static fn (string $value) => (float) $value,
            array_filter(
                $this->validated(),
                fn ($key) => in_array($key, $this->type()->parameters(), true),
                ARRAY_FILTER_USE_KEY,
            ),
        );
    }
}