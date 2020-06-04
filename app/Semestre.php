<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    public function annee_unvi(){
        return $this->belongsTo(Annee_univ::class);
    }

    public function liste_etudiant(){
        return $this->hasMany(Liste_etudiant::class);
    }

    public function enseigne(){
        return $this->hasMany(Enseigne::class);
    }
}
