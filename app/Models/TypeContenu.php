<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeContenu extends Model
{
    protected $primaryKey = 'id_type';
    protected $fillable = [
        'nom',
        
    ];
}
