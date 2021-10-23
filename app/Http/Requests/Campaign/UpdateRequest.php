<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
      $size = count($this->products);

      return [
        'campaign' => [ "required", "string",  "max:128" , Rule::unique('campaigns')->ignore($this->route('campaign')->id) ],
        'products' => 'sometimes|array',
        'products.*' => 'exists:products,id',
        'discounts' => 'required_with:products|array|size:' . $size ,
        'discounts.*' => 'numeric|gt:-1|lt:100'
      ];
    }
}
