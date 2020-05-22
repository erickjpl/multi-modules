<?php

namespace App\Http\Requests\API\Products\Sales;

use App\Models\Products\Sales\Inventory;
use InfyOm\Generator\Request\APIRequest;

class UpdateInventoryAPIRequest extends APIRequest
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
        $rules = Inventory::$rules;
        
        return $rules;
    }
}
