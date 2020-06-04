<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liste_etudiant extends Model
{
    public function etudiant(){
        return $this->belongsTo(Etudiant::class);
    }

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }
}
