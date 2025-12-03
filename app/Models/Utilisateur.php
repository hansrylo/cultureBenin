<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Contracts\Auth\MustVerifyEmail;

class Utilisateur extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, Notifiable;
    
    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'sexe',
        'role',
        'id_langue',
        'date_naissance',
        'statut',
        'photo'
    ];
    
    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_naissance' => 'date',
        'date_inscription' => 'datetime',
    ];
    
    protected $dates = [
        'date_naissance',
        'date_inscription',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    // Relation avec le rôle
    public function role()
    {
        return $this->belongsTo(Role::class, 'role');
    }
    
    // Relation avec la langue
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }
    
    // Relation avec les contenus (en tant qu'auteur)
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur');
    }
    
    // Relation avec les commentaires
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_utilisateur');
    }
    
    // Relation avec les contenus modérés (en tant que modérateur)
    public function contenusModeres()
    {
        return $this->hasMany(Contenu::class, 'id_moderateur');
    }
    
    // Méthodes de vérification des rôles
    public function hasRole($roleName)
    {
        return $this->role()->where('nom_role', $roleName)->exists();
    }
    
    public function isAdmin()
    {
        return $this->hasRole('admin') || $this->hasRole('administrateur');
    }
    
    public function isManager()
    {
        return $this->hasRole('manager') || $this->hasRole('gestionnaire') || $this->hasRole('moderateur');
    }
    
    public function canAccessAdmin()
    {
        return $this->isAdmin() || $this->isManager();
    }
    
    // Méthode pour le système d'authentification
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
    
    // Spécifier le nom du champ de mot de passe pour l'authentification
    public function getAuthPasswordName()
    {
        return 'mot_de_passe';
    }
    
    // Spécifier le nom du champ identifiant (email)
    public function getAuthIdentifierName()
    {
        return 'id_utilisateur';
    }

    // Relations pour les paiements et achats
    public function paiements()
    {
        return $this->hasMany(Paiement::class, 'id_utilisateur', 'id_utilisateur');
    }
    
    public function achats()
    {
        return $this->hasMany(AchatContenu::class, 'id_utilisateur', 'id_utilisateur');
    }
    
    public function contenusAchetes()
    {
        return $this->belongsToMany(Contenu::class, 'achats_contenus', 'id_utilisateur', 'id_contenu')
                    ->withTimestamps();
    }
    
    // Méthodes pour les achats
    public function aAchete($contenu)
    {
        if (!$contenu) {
            return false;
        }
        
        $contenuId = is_object($contenu) ? $contenu->id_contenu : $contenu;
        
        return $this->achats()
                    ->where('id_contenu', $contenuId)
                    ->whereHas('paiement', function($query) {
                        $query->where('statut', 'reussi');
                    })
                    ->exists();
    }
    
    public function peutAcceder($contenu)
    {
        // Si le contenu n'est pas premium, tout le monde peut y accéder
        if (!$contenu->estPremium()) {
            return true;
        }
        
        // Si l'utilisateur est l'auteur, il peut accéder
        if ($contenu->id_auteur == $this->id_utilisateur) {
            return true;
        }
        
        // Sinon, vérifier si l'utilisateur a acheté le contenu
        return $this->aAchete($contenu);
    }
    
    public function totalDepenses()
    {
        return $this->paiements()
                    ->where('statut', 'reussi')
                    ->sum('montant');
    }

    // Accessor pour le nom complet (utilisé par Auth::user()->name)
    public function getNameAttribute()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}
