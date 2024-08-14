<?php

namespace App\Http\Requests;

use App\Models\CarBody;
use App\Models\CarClass;
use App\Models\CarEngine;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|integer',
            'old_price' => ['sometimes', 'nullable', 'integer', 'gt:price'],
            'description' => 'required|string',
            'salon' => 'required|string',
            'kpp' => 'required|string',
            'year' => 'required|integer',
            'color' => 'required|string',
            'is_new' => 'boolean',
            'engine_id' => ['required', 'exists:' . CarEngine::class . ',id'],
            'class_id' => ['required', 'exists:' . CarClass::class . ',id'],
            'body_id' => ['required', 'exists:' . CarBody::class . ',id'],
            'categories' => ['required'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_new' => $this->has('is_new'),
        ]);
    }
}
