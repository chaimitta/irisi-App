<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Enseigne;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //la fonction qui affiche les espaces d'authentification selon la nature de user
    public function index(){
        $user = Auth::user();
        $categorie = $user->categorie;
        //si le user est l'administrateur
        if ($categorie == "1"){
            return redirect('/dashboard/adminProfesseur');
        }

        //si le user est un professeur
        else if ($categorie == "2")
        {
        $id=$user->id;
       
        $professeur2 = DB::table('professeurs')->select('id')->where('user_id', $id)->get();
        $idProfesseur=$professeur2->get(0)->id;
         
        $has=DB::table('enseignes')->where('professeur_id',$idProfesseur)->count();
 
        if($has==0){
            $message="Désolé ,Vous n'étes pas encore affecté à aucun module .";
            
            return view('Dashboard/professeur/dashboard',compact('user'),['message'=>$message,'nbr_modules'=>0]);
        }
        elseif($has>0)
        {

           $resultat = DB::select(DB::raw("SELECT * FROM enseignes,modules,semestres,niveaux 
           WHERE  enseignes.module_id = modules.id and enseignes.semestre_id = semestres.id 
           and enseignes.niveau_id = niveaux.id and enseignes.professeur_id = :id_professeur;"), array(
            'id_professeur' => $idProfesseur,));
            
        $count = DB::table('annee_univs')->select('id')->where('current',1)->count();
        // calcul du nombre de modules  affectés
        $nbr_modules=Enseigne::where('professeur_id', $idProfesseur)->count();
        
          if($count == 0 ){
            return view('Dashboard/professeur/dashboard',compact('user'),['resultat'=>$resultat,'nbr_modules'=>$nbr_modules]);
        }
        else{
            $anne = DB::table('annee_univs')->select('int_annee')->where('current',1)->get()->get(0);
       
            $anne_univ=$anne->int_annee;
           return view('Dashboard/professeur/dashboard',compact('user'),['resultat'=>$resultat,'anne_univ'=>$anne_univ,'nbr_modules'=>$nbr_modules]);
        }
            
        }
    }
        //si l'utilisateur est un étudiant
        else{
          
            $studentId = DB::table('etudiants')->select('id')->where('user_id', $user->id)->get();
       
            $id = $studentId->get(0)->id;
            $results = DB::select( DB::raw("SELECT semestre_id, niveau_id FROM liste_etudiants WHERE etudiant_id = :id_v"), array(
                'id_v' => $id,
            ));
            $semestre_id = $results[0]->semestre_id;
            $niveau_id = $results[0]->niveau_id;
            //on recupere la liste des modules du semestre courant
            $modules = DB::select(DB::raw("SELECT * FROM enseignes,modules 
            WHERE enseignes.module_id = modules.id and enseignes.semestre_id = :semestre_id
             and enseignes.niveau_id = :niveau_id"), array(
                'semestre_id' => $semestre_id,
                'niveau_id' => $niveau_id,
            ));
    
            return view('Dashboard/etudiant/tableau-de-bord',['user'=>$user,'modules'=>$modules,
            'semestre_id'=>$semestre_id,'niveau_id'=>$niveau_id]);
     

        }

         
    }

}
