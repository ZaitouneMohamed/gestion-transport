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
        "status",
        "ville",
        "km_proposer",
        "n_magasin"
    ];

    protected $casts = [
        'date' => 'date'
    ];

    // Relationships
    public function bons()
    {
        return $this->hasMany(Bons::class);
    }

    public function chaufeur()
    {
        return $this->belongsTo(Chaufeur::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function camion()
    {
        return $this->belongsTo(Camion::class);
    }

    // Scopes for better query building
    public function scopeWithCalculatedValues($query)
    {
        return $query->with([
            'chaufeur:id,full_name',
            'camion:id,matricule,consommation',
            'station:id,name',
            'bons' => function ($query) {
                $query->where('nature', 'gazole')
                      ->select('id', 'consomation_id', 'km', 'qte_litre', 'prix', 'nature')
                      ->orderBy('id');
            }
        ]);
    }

    public function scopeForDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('date', 'desc');
    }

    // Keep legacy accessors for backward compatibility but mark as deprecated
    // These should be replaced with the calculated values from controller

    /**
     * @deprecated Use calculated_values from controller instead
     */
    public function getQtyLittreAttribute()
    {
        if (isset($this->calculated_values['qty_littre'])) {
            return $this->calculated_values['qty_littre'];
        }

        // Fallback to old logic (should be avoided)
        $bons = $this->bons()->where('nature', 'gazole')->orderBy('id')->get();

        if ($bons->count() < 2) {
            return null;
        }

        $firstBon = $bons->first();
        $lastBon = $bons->last();

        if (!$firstBon->km || !$lastBon->km) {
            return null;
        }

        return $bons->sum('qte_litre') - $firstBon->qte_litre;
    }

    /**
     * @deprecated Use calculated_values from controller instead
     */
    public function getKmTotalAttribute()
    {
        if (isset($this->calculated_values['km_total'])) {
            return $this->calculated_values['km_total'];
        }

        // Fallback to old logic
        $bons = $this->bons()->where('nature', 'gazole')->orderBy('id')->get();

        if ($bons->count() < 2) {
            return null;
        }

        $firstBon = $bons->first();
        $lastBon = $bons->last();

        if (!$firstBon->km || !$lastBon->km) {
            return null;
        }

        return $lastBon->km - $firstBon->km;
    }

    /**
     * @deprecated Use calculated_values from controller instead
     */
    public function getTauxAttribute()
    {
        if (isset($this->calculated_values['taux'])) {
            return $this->calculated_values['taux'];
        }

        // Fallback to old logic
        $qtyLittre = $this->getQtyLittreAttribute();
        $kmTotal = $this->getKmTotalAttribute();

        if (!$qtyLittre || !$kmTotal || $kmTotal <= 0) {
            return null;
        }

        return $qtyLittre / $kmTotal * 100;
    }

    /**
     * @deprecated Use calculated_values from controller instead
     */
    public function getPrixAttribute()
    {
        if (isset($this->calculated_values['prix'])) {
            return $this->calculated_values['prix'];
        }

        // Fallback to old logic
        $bons = $this->bons()->where('nature', 'gazole')->orderBy('id')->get();

        if ($bons->count() < 2) {
            return 0;
        }

        $firstBon = $bons->first();
        $lastBon = $bons->last();

        if (!$firstBon->km || !$lastBon->km) {
            return 0;
        }

        return $bons->sum('prix') - $firstBon->prix;
    }

    /**
     * @deprecated Use calculated_values from controller instead
     */
    public function getStatueAttribute()
    {
        if (isset($this->calculated_values['statue'])) {
            return $this->calculated_values['statue'];
        }

        // Fallback to old logic
        $taux = $this->getTauxAttribute();

        if (!$taux || !$this->camion->consommation) {
            return null;
        }

        return $taux - $this->camion->consommation;
    }

    public function getFullPrixAttribute()
    {
        return $this->bons()->sum('prix');
    }

    // Helper methods for cleaner code
    public function hasCompleteBons(): bool
    {
        return $this->bons()->where('nature', 'gazole')->count() >= 2;
    }

    public function isComplete(): bool
    {
        return $this->status === 1;
    }

    public function getGazoleBons()
    {
        return $this->bons()->where('nature', 'gazole')->orderBy('id')->get();
    }
}
