<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class phases extends Model
{
    protected $table = 'phases';
    protected $fillable = [
        'id',
        'phase_name',
        'Created_by',
    ];


}
