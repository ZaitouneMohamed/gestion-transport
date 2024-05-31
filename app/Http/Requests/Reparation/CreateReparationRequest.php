<?php

namespace App\Http\Requests\Reparation;

use Illuminate\Foundation\Http\FormRequest;

class CreateReparationRequest extends FormRequest
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
            // "chaufeur_id" => "required",
            // "camion_id" => "required",
            "date" =>  "required",
            "n_bon" =>  "required|unique:reparations,n_bon",
            // "reparation" =>  "required",
            // "fournisseur" =>  "required",
            "solde" =>  "required",
            // "type" =>  "required",
            // "nature" =>  "required"
        ];
    }
}
