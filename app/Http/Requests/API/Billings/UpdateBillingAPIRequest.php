<?php

namespace App\Http\Requests\API\Billings;

use Illuminate\Support\Arr;
use App\Models\Billings\Billing;
use InfyOm\Generator\Request\APIRequest;

class UpdateBillingAPIRequest extends APIRequest
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
        $rules = Billing::$rules;
        
        return Arr::only($rules, array('status', 'customer_id'));
    }
}
