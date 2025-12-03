<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_media';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $table = 'medias';


    protected $fillable = [
        'chemin',
        'description',
        'id_type',
        'id_contenu'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu', 'id_contenu');
    }
}
