<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Session;
use PDF;
use Auth;
class ListeStudentsController extends Controller
{

    //la fonction qui affiche la liste des étudiants au professeur pour un niveau et un semestre
     public function index($niveau, $semestre)
     {
        
        $idN=$niveau;
        $idS=$semestre;
        // dd($idN);
            $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,users,niveaux,semestres
            WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
            and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
            and users.id=etudiants.user_id and deleted = 0"), array(
            'idN' => $idN,'idS'=>$idS,'idNi' => $idN,'idSe'=>$idS));

               $user= Session::get('user');
            $nombre= count($resultat);  
            return view('Dashboard/professeur/listeEtudiant',['resultat' =>$resultat,'user'=>$user,'nombre'=>$nombre]); 
        
     }


     public function import(Request $request){
        
         $data1=unserialize(request('data'));
         $nom_fichier='IRISI'.$data1[0]->int_niveau.$data1[0]->int_semestre.'.pdf';
      
         ini_set('max_execution_time', 180); //3 minutes
        $pdf = PDF::loadView('Dashboard/professeur/pdf/pdf', $data1);
      return $pdf->download($nom_fichier);
     }
}

