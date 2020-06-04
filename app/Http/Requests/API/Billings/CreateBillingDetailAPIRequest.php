<?php

namespace App\Http\Requests\API\Billings;

use App\Models\Billings\BillingDetail;
use InfyOm\Generator\Request\APIRequest;

class CreateBillingDetailAPIRequest extends APIRequest
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
        return BillingDetail::$rules;
    }
}
