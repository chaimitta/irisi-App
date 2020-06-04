<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enseigne extends Model
{
    public function professeur(){
        return $this->belongsTo(Professeur::class);
    }

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }
}
