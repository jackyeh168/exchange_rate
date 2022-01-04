<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ExchangeRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currency_types = $this->getCurrencyTypeList();
        
        return [
            'from' => 'required|string|in:' . implode(',', $currency_types), // origin currency
            'to' => 'required|string|in:' . implode(',', $currency_types), // target currency
            'price'=>'required|numeric'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $responseData = $validator->errors();
        $response = response()->json($responseData, Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }

    private function getCurrencyTypeList()
    {
        return collect(config('exchange_rate.currencies'))->keys()->all();
    }
}
