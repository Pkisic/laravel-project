<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name' => ['required','string','unique:brands,name','max:25'],
            'description' => ['string','max:255','nullable'],
            'image' => ['image','nullable','file'],
            'url' => ['url','active_url','nullable']
        ];
    }
}
