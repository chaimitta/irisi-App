<?php

namespace App\Exports;

use App\Examen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use \App\Note;
use Session;
use DB;
use Symfony\Component\HttpFoundation\Request;

class NotesExports implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        $libelle = Session::get('libelleToExport');
        $idNiveau = Session::get('idNiveauToExport');

        $idSemestre = Session::get('idSemestreToExport');
        $query = DB::table('liste_etudiants')->select('etudiant_id')->where(function ($select) use ($idNiveau, $idSemestre) {
            $select->where('niveau_id', $idNiveau)
                ->where('semestre_id', $idSemestre);
        })->get();
        foreach ($query as $q) {
            $data[] = $q->etudiant_id;
        }

        $idModule = DB::table('modules')->where('libelle', $libelle)->get()->get(0)->id;
        $data= join(",",$data);
         
     $resultat = DB::select(DB::raw(" 
      select DISTINCT nom,prenom,C1,C2 from users,etudiants ,notes 
      where users.id=etudiants.user_id AND etudiants.deleted=0 AND notes.etudiant_id=etudiants.id AND
       notes.module_id=:idModule   and etudiants.id IN (".$data.")
      "), array(
            'idModule' => $idModule,
           
        ));
  
          $count=count($resultat);

        return view('Dashboard/professeur/listeNotes', ['resultat' => $resultat,'count'=>$count]);
    }
}