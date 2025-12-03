<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id_role';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    
    protected $fillable = [
        'nom_role'
    ];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    // Relation avec les utilisateurs
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'role');
    }
}
