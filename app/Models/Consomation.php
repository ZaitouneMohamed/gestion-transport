<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consomation extends Model
{
    use HasFactory;

    protected $fillable = [
        "chaufeur_id",
        "camion_id",
        "date",
        "description",
        "ville",
    ];
    public function Bons()
    {
        return $this->hasMany(Bons::class);
    }
    public function chaufeur()
    {
        return $this->belongsTo(Chaufeur::class);
    }
    public function Station()
    {
        return $this->belongsTo(Station::class);
    }
    public function Camion()
    {
        return $this->belongsTo(Camion::class);
    }
    public function getQtyLittreAttribute()
    {
        $bons = $this->Bons()->gazole()->orderByDesc('id')->get();
        $last_bon = $bons->first();
        $first_bon = $bons->last();
        if ($bons->count() > 1 && $first_bon->km > 0 && $last_bon->km > 0) {
            $first = $first_bon->qte_litre;
            $qte_littre = $bons->sum('qte_litre') - $first;
            return $qte_littre;
        }
        return null;
    }
    public function getKmTotalAttribute()
    {
        $bons = $this->Bons()->gazole()->orderByDesc('id')->get();
        $first_bon = $bons->last();
        $last_bon = $bons->first();
        if ($bons->count() > 1 && $first_bon->km > 0 && $last_bon->km > 0) {
            $kmdepart = $first_bon->km;
            $kmreturn = $last_bon->km;
            $KmTotal = $kmreturn - $kmdepart;
            return $KmTotal;
        }
    }

    public function getTauxAttribute()
    {
        $bons = $this->Bons()->gazole()->orderByDesc('id')->get();
        $first_bon = $bons->last();
        $last_bon = $bons->first();
        if ($bons->count() > 1 && $first_bon->km > 0 && $last_bon->km > 0) {
            $qtylittre = $this->getQtyLittreAttribute();
            $KmTotal = $this->getKmTotalAttribute();
            if ($KmTotal > 0) {
                return $qtylittre  / $KmTotal * 100;
            }
        }
    }

    public function getPrixAttribute()
    {
        $bons = $this->Bons()->gazole()->orderByDesc('id')->get();
        $first_bon = $bons->last();
        $last_bon = $bons->first();
        if ($bons->count() > 1 && $first_bon->km > 0 && $last_bon->km > 0) {
            $bons = $this->Bons()->gazole();
            $first = $bons->first()->prix;
            $prix = $bons->sum('prix') - $first;
            return $prix;
        }
    }

    public function getStatueAttribute()
    {
        $bons = $this->Bons()->gazole()->orderByDesc('id')->get();
        $first_bon = $bons->last();
        $last_bon = $bons->first();
        if ($bons->count() > 1 && $first_bon->km > 0 && $last_bon->km > 0) {
            if ($bons->count() > 1) {
                $taux = $this->getTauxAttribute();
                $camionconsomation = $this->Camion->consommation;
                $statue = $taux - $camionconsomation;
                return $statue;
            }
        }
        // return '<span class="badge bg-secondary">New</span>';
    }
}
