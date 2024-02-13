<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etablissements extends Model
{

    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo('App\sections');
    }
    public function phase()
    {
        return $this->belongsTo('App\phases');
    }
    public function product()
    {
        return $this->belongsTo('App\products');
    }
}
