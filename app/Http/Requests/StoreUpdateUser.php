<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUpdateUser extends FormRequest
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
        $plan = $this->route()->parameter('name');
        $id = $this->segment(3);
        $rules =  [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', "unique:users,email,{$id},id"],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

      //  verifica o tipo de method
      //  dd($this->method());

      /**
       * validação para ignorar quando a senha quando for method put
       */
        if($this->method() == 'PUT') {
            $rules['password'] = ['nullable', Rules\Password::defaults()];
        }else {
            $rules['password'] = ['required', Rules\Password::defaults()];
        }

        return $rules;
    }
}
