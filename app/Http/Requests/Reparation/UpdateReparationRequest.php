<?php

namespace App\Http\Requests\Reparation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReparationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "date" =>  "required",
            "n_bon" =>  "required",
            "solde" =>  "required",
        ];
    }
}
