<?php

namespace App\Http\Requests\API\Profile;

use Illuminate\Support\Arr;
use App\Models\Profile\User;
use InfyOm\Generator\Request\APIRequest;

class UpdateUserAPIRequest extends APIRequest
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
        $rules = User::$rules;
        
        return Arr::only($rules, array('name', 'email'));
    }
}
