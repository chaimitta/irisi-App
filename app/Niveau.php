<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    public function liste_etudiant(){
        return $this->hasMany(Liste_etudiant::class);
    }

    public function enseigne(){
        return $this->hasMany(Enseigne::class);
    }
}
