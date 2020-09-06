<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Examen;
 use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use \App\Note;
use Session;
use DB;
use Symfony\Component\HttpFoundation\Request;

class NotesEtudiant implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        $id=Session::get('idEtudiant');
        $query=DB::select(DB::raw("select * from notes,modules where notes.module_id=modules.id and notes.etudiant_id=?"),[
            $id
        ]);
       
        return view('Dashboard/etudiant/liste_notes', ['resultat' => $query]);
    }
}
