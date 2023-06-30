<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUpdateProduct extends FormRequest
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

        $id = $this->segment(3);
        $rules = [
            'title' => ['required', 'min:3', 'max:255', "unique:products,title,{$id},id"],
            'description' => ['required','min:3','max:500'],
            'image' => ['required', 'image'],
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        ];

      //  verifica o tipo de method
      //  dd($this->method());

      /**
       * validação para ignorar quando a senha quando for method put
       */

        if($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
