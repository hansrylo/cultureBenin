<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchatContenu extends Model
{
    protected $table = 'achats_contenus';
    
    protected $fillable = [
        'id_utilisateur',
        'id_contenu',
        'id_paiement',
        'date_achat',
    ];
    
    protected $casts = [
        'date_achat' => 'datetime',
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
    
    public function paiement()
    {
        return $this->belongsTo(Paiement::class, 'id_paiement', 'id_paiement');
    }
    
    // Méthodes
    public function estValide()
    {
        return $this->paiement && $this->paiement->estReussi();
    }
}
