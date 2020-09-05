<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NotesExports;
use Session;
use Illuminate\Support\Facades\Auth;
use Redirect;

class NotesController extends Controller
{
    //la fonction qui affiche les notes des étudiants au professeur
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;

        $professeur = DB::table('professeurs')->select('id')->where('user_id', $id)->get();
        $idProfesseur = $professeur->get(0)->id;

        $has = DB::table('enseignes')->where('professeur_id', $idProfesseur)->count();
        //le professeur n'est pas encore affecté à un module
        if ($has == 0) {
            $message = "Désolé ,Vous n'étes pas affecté encore à aucun module .";

            return view('Dashboard/professeur/notes', compact('user'), compact('message'));
        } 
        //le professeur a été déjà affectéau moins à un module
        elseif ($has > 0) {

            $resultat = DB::select(DB::raw("SELECT * FROM enseignes,modules, niveaux  WHERE  enseignes.professeur_id=:id_professeur and enseignes.module_id = modules.id   and enseignes.niveau_id = niveaux.id  ;"), array(
                'id_professeur' => $idProfesseur,));



            return view('Dashboard/professeur/notes', compact('resultat'), compact('user'));
        }
    }


//la fonction qui affiche les notes des étudiants dans un module au professeur
    public function export($libelle,$idNiveau,$idSemestre)
    {
    
       $idModule=DB::table('modules')->where('libelle',$libelle)->get()->get(0)->id;
       $count=DB::table('notes')->where('module_id',$idModule)->count();
       //aucune note ajoutée pour le module voulu
       if($count==0){
            $user = Auth::user();
           $id = $user->id;
   
           $professeur = DB::table('professeurs')->select('id')->where('user_id', $id)->get();
           $idProfesseur = $professeur->get(0)->id;
   
               $resultat = DB::select(DB::raw("SELECT * FROM enseignes,modules, niveaux  WHERE  enseignes.professeur_id=:id_professeur and enseignes.module_id = modules.id   and enseignes.niveau_id = niveaux.id  ;"), array(
                   'id_professeur' => $idProfesseur,));
   
                   $message="Aucune note n'a été ajouté pour ce module !";
  
               return view('Dashboard/professeur/notes',['resultat'=>$resultat,'user'=>$user,'message'=>$message]);
            
               }
      //il y'a des notes pour ce module => on exporte les notes sous forme d'un fichier EXcel
       else{
            Session::put('libelleToExport',$libelle);
            Session::put('idNiveauToExport',$idNiveau);
            Session::put('idSemestreToExport',$idSemestre);

          return Excel::download(new NotesExports, 'notes.xlsx');
        
       }
          }



    //la fonction qui affiche les notes d'un module à un étudiant
      public function voir_etudiant($libelle){
        $user = Auth::user();
        $studentId = DB::table('etudiants')->select('id')->where('user_id', $user->id)->get() ;
        $id = $studentId->get(0)->id;
        $idModule = DB::table('modules')->select('id')->where('libelle', $libelle)->get()->get(0)->id;

        //on teste si jamais aucune note a été ajoutée pour ce module
        $res = DB::table('notes')->select('id')->where(function($query) use($id,$idModule){
            $query->where('etudiant_id',$id)
                ->where('module_id',$idModule);
        })->count() ;
        
        //aucune note ajoutée pour ce module
        if($res <= 0){
            $message = "aucune note ajoutée";
            return view('Dashboard/etudiant/listeNotes',['message'=>$message,'libelle'=>$libelle]);
        }
        //on récupére les notes
        else{

            $resultat = DB::select(DB::raw(" 
            select C1,C2 from notes 
            where etudiant_id=:idE and  module_id=:idM
            "), array(
                 'idE'=>$id,
                 'idM'=>$idModule,
                 
                 
              ));
      
              return view('Dashboard/etudiant/listeNotes',['resultat'=>$resultat,'libelle'=>$libelle]);
        }

    }



//la fonction qui affiche à un professeur un page pour ajouter ou modifier les notes
        public function ajouter_notes( $libelle, $idNiveau, $idSemestre)
    {
           
        $query2=DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0)->id;
                 $do=DB::table('notes')->select('id')->where('module_id',$query2)->count();
                
                 //la table notes est remplie
                 if($do != 0){

                     $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,notes,users,niveaux,semestres
                      WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
                      and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
                      and users.id=etudiants.user_id and deleted = 0 and notes.etudiant_id=liste_etudiants.etudiant_id and module_id=:idM")
                      , array('idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre,'idM'=>$query2));
                     
                 }
                 //la table notes est vide
                 else{

                $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,users,niveaux,semestres
                WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
                and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
                and users.id=etudiants.user_id and deleted = 0")
                  , array('idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre));
                 }

  
        return view('Dashboard/professeur/ajouterNotes', ['resultat' =>$resultat,'libelle' => $libelle, 'idN' => $idNiveau, 'idS' => $idSemestre]);
    }



//la fonction qui permet à un professeur d'ajouter ou modifier les notes
    public function ajouter_notes2($libelle,Request $request,$idNiveau,$idSemestre){
        $query2=DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0)->id;
        $query1=DB::table('etudiants')->select('id')->where('cne',$request->cne)->get()->get(0)->id;

            
             $count=DB::table('notes')->where(function ($select) use ($query1 , $query2) {
                     $select->where('etudiant_id', $query1)
                          ->where('module_id', $query2);
                })->count();
               
              //aucune note a été ajoutée pour cet etudiant dance ce module => insert
                if($count!=1){
                     $query = DB::table('notes')->insert(

                [ 'etudiant_id'=>$query1,
                'module_id'=>$query2,  
                'C1' => $request->c1,
                'C2' => $request->c2]
            );
    
    $message1="les données sont ajoutées avec succés !";
        
    //on recupere les nouvelles notes des étudiants
        $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,notes,users,niveaux,semestres
        WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
        and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
        and users.id=etudiants.user_id and deleted = 0 and notes.etudiant_id=liste_etudiants.etudiant_id and module_id=:idM"), array(
        'idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre,'idM'=>$query2));
    
    return view('Dashboard/professeur/ajouterNotes', ['resultat' =>$resultat,'message1'=>$message1,'idS'=>$idSemestre,'idN'=>$idNiveau,'libelle'=>$libelle]);
      
   }
   //les notes ont été déjà ajoutées pour cet étudiant dans ce module => update
    else{

        $query = DB::table('notes')->where(function ($select) use ($query1 , $query2) {
                 $select->where('etudiant_id', $query1)
                       ->where('module_id', $query2);
             })
             ->update(

                 [
                 
                 'C1' => $request->c1,
                'C2' => $request->c2
                ]
              );

                   $message1="les données sont ajoutées avec succés !";
                   $query2=DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0)->id;

                //on récupére les nouvelles notes
                 $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,notes,users,niveaux,semestres
                 WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
                 and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
                 and users.id=etudiants.user_id and deleted = 0 and notes.etudiant_id=liste_etudiants.etudiant_id and module_id=:idM"), array(
                 'idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre,'idM'=>$query2));
               
                 return view('Dashboard/professeur/ajouterNotes', ['resultat' =>$resultat,'message1'=>$message1,'idS'=>$idSemestre,'idN'=>$idNiveau,'libelle'=>$libelle]);
             
            
         
                }
      }
      
}