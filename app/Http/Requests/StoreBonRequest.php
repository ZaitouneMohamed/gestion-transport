<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBonRequest extends FormRequest
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
            "date" => "required",
            "qte_litre" => "required",
            "station_id" => "required",
            "tarif" => "required",
            "date" => "required",
            "numero_bon" => "required",
            "km_return" => "required",
            "nature" => "required"
        ];
    }
}
