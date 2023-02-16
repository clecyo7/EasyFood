<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class UpdatePlan extends FormRequest
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
        return [
            'name' => "required|min:3|max:255",
             ValidationRule::unique('plans')->ignore($plan),
            'description' => 'nullable|min:3|max:255',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'Campo nome só permite 255 caracteres',
            'name.unique' => 'O nome já foi escolhido.',
            'description.min' => 'A descrição deve ter pelo menos 3 caracteres.',
            'description.max' => 'Campo nome só permite 255 caracteres',
            'price.required' => 'O campo preço é obrigatório.',

        ];
    }
}
