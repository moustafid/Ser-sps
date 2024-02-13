<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LycSituation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'Number_manko',
        'Phase_id',
        'Etablissement',
        'Number_hk',

        'Credit_OSB',
        'Revenues_OSB',
        'Expenses_OSB',
        'Credit_Fin_Month_OSB',

        'Credit_OIEB',
        'Revenues_OIEB',
        'Expenses_OIEB',
        'Credit_Fin_Month_OIEB',
        'Total',
        'note',
    ];

    protected $dates = ['deleted_at'];

    public function phase(): BelongsTo
    {
        return $this->belongsTo('App\phases');
    }

    public function etablissement(): BelongsTo
    {
        return $this->belongsTo('App\Etablissements');
    }
}
