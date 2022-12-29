<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutComingStocksRequest extends FormRequest
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
        $date = 'required';
        $customer_name = 'required';
        $dataStock = 'required';

        return [
            'date' => $date,
            'customer_name' => $customer_name,
            'dataStock' => $dataStock,
        ];
    }
}
