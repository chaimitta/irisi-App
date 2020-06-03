<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annee_univ extends Model
{
    public function semestre(){
        return $this->hasMany(Semestre::class);
    }
}
