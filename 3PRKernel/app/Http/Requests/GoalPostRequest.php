<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Exceptions\HttpResponseException;

class GoalPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected function failedValidation(Validator $validator) : JsonResponse
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException (
            new JsonResponse(
                ['error' => $errors], 
                400
            )
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.name' => 'required|string',
            'data.weight_goal' => 'required|numeric',
            'data.rep_goal' => 'required|integer'
        ];
    }
}
