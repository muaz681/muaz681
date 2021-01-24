<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidation extends FormRequest
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
        return [
          'category_id' => 'required',
          'product_name' => 'required|string',
          'product_short_text' => 'required|string',
          'product_long_text' => 'required|string',
          'product_price' => 'required|numeric',
          'product_quantity' => 'required|numeric',
          'alert_quantity' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
          'category_id.required' => 'Please Select Category name!',
          'product_name.required' => 'Please insert your product name!',
          'product_short_text.required' => 'Please insert your product Short Description!',
          'product_long_text.required' => 'Please insert your product Long Description!',
          'product_price.required' => 'Please insert your product price!',
          'product_price.numeric' => 'Please type must be a number',
          'product_quantity.required' => 'Please insert your product Quantity!',
          'product_quantity.numeric' => 'Please type must be a number',
          'alert_quantity.required' => 'Please insert your product alert Quantity!',
          'alert_quantity.numeric' => 'Please type must be a number',
        ];
    }
}
