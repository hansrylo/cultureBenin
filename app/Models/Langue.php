<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Langue extends Model
{
    use SoftDeletes;
    
    
    protected $primaryKey = 'id_langue';
    protected $fillable = [
        'nom_langue',
        'code_langue',
        'description'
    ];
    
}
