<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class StoreNfeRequest extends FormRequest
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
            'numero' => 'required|string|unique:nfes,numero|size:9',
            'valor' => 'required|numeric',
            'data_emissao' => 'required|date',
            'nome_remetente' => 'required|string|max:100',
            'nome_transportador' => 'required|string|max:100',
            'cnpj_remetente' => 'required|string',
            'cnpj_transportador' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'numero.required' => 'A numero is required',
            'numero.size' => 'The numero does not have 9 characters',
            'valor.required' => 'A valor is required',
            'data_emissao.required' => 'A data_emissao is required',
            'cnpj_remetente.required' => 'A cnpj_remetente is required',
            'nome_remetente.required' => 'A nome_remetente is required',
            'cnpj_transportador.required' => 'A cnpj_transportador is required',
            'nome_transportador.required' => 'A nome_transportador is required',
        ];
    }

    /**
     * Throw a response with exception
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation error',
                'error' => $validator->errors(),
            ], 401)
        );
    }
}
