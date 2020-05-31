<?php

namespace App\Http\Requests\API\Customers;

use Illuminate\Support\Arr;
use App\Models\Customers\Customer;
use InfyOm\Generator\Request\APIRequest;

class UpdateCustomerAPIRequest extends APIRequest
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
        $rules = Customer::$rules;
        
        return Arr::except($rules, array('dni'));
    }
}
