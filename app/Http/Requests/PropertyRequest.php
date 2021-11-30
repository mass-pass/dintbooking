<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PropertyRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules = [
            'property_type_id'  => 'required',
            'space_type'        => 'required',
            'accommodates'      => 'required',
            'map_address'       => 'required',
        ];
        if ($request->is('admin/*')) {
            $rules['host_id']   = 'required';
        }
        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'property_type_id.required'     => 'Home Type is required',
            'space_type.required'           => 'Room Type is required',
            'accommodates.required'         => 'Accommodates is required',
            'map_address.required'          => 'City is required',
            'host_id.required'              => 'Host is required',
        ];
    }

}
