<?php

namespace App\Http\Requests\API\Customers;

use App\Models\Customers\Customer;
use InfyOm\Generator\Request\APIRequest;

class CreateCustomerAPIRequest extends APIRequest
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
        return Customer::$rules;
    }
}