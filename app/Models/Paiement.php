<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';
    protected $primaryKey = 'id_paiement';
    
    protected $fillable = [
        'id_utilisateur',
        'id_contenu',
        'montant',
        'devise',
        'statut',
        'methode_paiement',
        'fedapay_transaction_id',
        'fedapay_status',
        'metadata',
        'date_paiement',
    ];
    
    protected $casts = [
        'metadata' => 'array',
        'date_paiement' => 'datetime',
        'montant' => 'decimal:2',
    ];
    
    // Relations
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id_utilisateur');
    }
    
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu', 'id_contenu');
    }
    
    public function achat()
    {
        return $this->hasOne(AchatContenu::class, 'id_paiement', 'id_paiement');
    }
    
    // Scopes
    public function scopeReussis($query)
    {
        return $query->where('statut', 'reussi');
    }
    
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }
    
    public function scopeParMethode($query, $methode)
    {
        return $query->where('methode_paiement', $methode);
    }
    
    // Méthodes
    public function estReussi()
    {
        return $this->statut === 'reussi';
    }
    
    public function estEchoue()
    {
        return $this->statut === 'echoue';
    }
    
    public function estEnAttente()
    {
        return $this->statut === 'en_attente';
    }
    
    public function montantFormate()
    {
        return number_format($this->montant, 0, ',', ' ') . ' ' . $this->devise;
    }
    
    public function marquerCommeReussi()
    {
        $this->update([
            'statut' => 'reussi',
            'date_paiement' => now(),
        ]);
    }
    
    public function marquerCommeEchoue()
    {
        $this->update([
            'statut' => 'echoue',
        ]);
    }
}
