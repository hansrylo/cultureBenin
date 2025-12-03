<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    protected $primaryKey = 'id_contenu';
    protected $fillable = [
        'titre',
        'id_type',
        'texte',
        'date_creation',
        'statut',
        'id_auteur',
        'id_langue',
        'id_region',
        'parent',
        'id_moderateur',
        'date_validation',
        'est_premium',
        'prix',
    ];
    
    public function type()
    {
        return $this->belongsTo(TypeContenu::class, 'id_type', 'id_type');
    }
    
    public function auteur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_auteur', 'id_utilisateur');
    }
    
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }
    
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id_region');
    }
    
    public function moderateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_moderateur', 'id_utilisateur');
    }
    
    public function parentContenu()
    {
        return $this->belongsTo(Contenu::class, 'parent', 'id_contenu');
    }
    
    public function medias()
    {
        return $this->hasMany(Media::class, 'id_contenu', 'id_contenu');
    }
    
    // Relations pour les paiements et achats
    public function achats()
    {
        return $this->hasMany(AchatContenu::class, 'id_contenu', 'id_contenu');
    }
    
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'id_contenu', 'id_contenu');
    }
    
    public function acheteurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'achats_contenus', 'id_contenu', 'id_utilisateur')
                    ->withTimestamps();
    }
    
    // Méthodes pour le contenu premium
    public function estPremium()
    {
        return $this->est_premium == true;
    }
    
    public function prixFormate()
    {
        if (!$this->prix) {
            return 'Gratuit';
        }
        return number_format($this->prix, 0, ',', ' ') . ' XOF';
    }
    
    public function estAchetePar($utilisateur)
    {
        if (!$utilisateur) {
            return false;
        }
        
        return $this->achats()
                    ->where('id_utilisateur', $utilisateur->id_utilisateur)
                    ->whereHas('paiement', function($query) {
                        $query->where('statut', 'reussi');
                    })
                    ->exists();
    }
    
    public function getApercu($longueur = 200)
    {
        if (strlen($this->texte) <= $longueur) {
            return $this->texte;
        }
        
        return substr($this->texte, 0, $longueur) . '...';
    }
}
