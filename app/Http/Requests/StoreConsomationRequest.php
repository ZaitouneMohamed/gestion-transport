<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsomationRequest extends FormRequest
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
            "chaufeur_id" => "required",
            "camion_id" => "required",
            "nombre_magasin" => "required",
            "ville" => "required",
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'chaufeur_id.required' => 'Le chauférateur est obligatoire',
    //         'station_id.required' =>  'La station de départ est obligatoire',
    //         'camion_id.required' => 'le camion est obligatoire ',
    //         'ville.required'   => "la ville d'arrivée est obligatoire",
    //         'date.required'     => " la date du trajet est obligatoire",
    //         'qte_littre.required'    => " le nombre litre consommésest obligatoire ",
    //         'km_depart.required'      => " les kilomètres parcourus lorsdu chargement sont obligatoires.",
    //     ];
    // }
}
