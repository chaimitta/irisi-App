<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    public function annee_unvi(){
        return $this->belongsTo(Annee_univ::class);
    }

    public function module(){
        return $this->hasMany(Module::class);
    }
}
