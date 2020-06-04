<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function liste_etudiant(){
        return $this->hasMany(Liste_etudiant::class);
    }
}
