<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function semestre(){
        return $this->belongsTo(Semestre::class);
    }

    public function enseigne(){
        return $this->hasMany(Enseigne::class);
    }
}
