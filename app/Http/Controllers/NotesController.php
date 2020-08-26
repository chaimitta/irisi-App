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
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;

        $professeur = DB::table('professeurs')->select('id')->where('user_id', $id)->get();
        $idProfesseur = $professeur->get(0)->id;

        $has = DB::table('enseignes')->where('professeur_id', $idProfesseur)->count();
        if ($has == 0) {
            $message = "Désolé ,Vous n'étes pas affecté encore à aucun module .";

            return view('Dashboard/professeur/notes', compact('user'), compact('message'));
        } elseif ($has > 0) {

            $resultat = DB::select(DB::raw("SELECT * FROM enseignes,modules, niveaux  WHERE  enseignes.professeur_id=:id_professeur and enseignes.module_id = modules.id   and enseignes.niveau_id = niveaux.id  ;"), array(
                'id_professeur' => $idProfesseur,));



            return view('Dashboard/professeur/notes', compact('resultat'), compact('user'));
        }
    }



    public function export($libelle,$idNiveau,$idSemestre)
    {
    
       $idModule=DB::table('modules')->where('libelle',$libelle)->get()->get(0)->id;
       $count=DB::table('notes')->where('module_id',$idModule)->count();
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
      
       else{
  Session::put('libelleToExport',$libelle);
  Session::put('idNiveauToExport',$idNiveau);
  Session::put('idSemestreToExport',$idSemestre);

          return Excel::download(new NotesExports, 'notes.xlsx');
        
       }
          }


      public function voir_etudiant($libelle){
        $user = Auth::user();
        $studentId = DB::table('etudiants')->select('id')->where('user_id', $user->id)->get() ;
        $id = $studentId->get(0)->id;
        $idModule = DB::table('modules')->select('id')->where('libelle', $libelle)->get()->get(0)->id;

        
        $res = DB::table('notes')->select('id')->where(function($query) use($id,$idModule){
            $query->where('etudiant_id',$id)
                ->where('module_id',$idModule);
        })->count() ;
        if($res <= 0){
            $message = "aucune note ajoutée";
            return view('Dashboard/etudiant/listeNotes',['message'=>$message,'libelle'=>$libelle]);
        }
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


        public function ajouter_notes( $libelle, $idNiveau, $idSemestre)
    {
           
       
        $query2=DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0)->id;
                 $do=DB::table('notes')->select('id')->where('module_id',$query2)->count();
                
                 if($do != 0){

                     $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,notes,users,niveaux,semestres
                      WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
                      and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
                      and users.id=etudiants.user_id and deleted = 0 and notes.etudiant_id=liste_etudiants.etudiant_id and module_id=:idM")
                      , array('idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre,'idM'=>$query2));
                     
                 }
                 else{

                $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,users,niveaux,semestres
                WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
                and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
                and users.id=etudiants.user_id and deleted = 0")
                  , array('idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre));
                 }

  
        return view('Dashboard/professeur/ajouterNotes', ['resultat' =>$resultat,'libelle' => $libelle, 'idN' => $idNiveau, 'idS' => $idSemestre]);
    }


    public function ajouter_notes2($libelle,Request $request,$idNiveau,$idSemestre){
        $query2=DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0)->id;
        $query1=DB::table('etudiants')->select('id')->where('cne',$request->cne)->get()->get(0)->id;

            
             $count=DB::table('notes')->where(function ($select) use ($query1 , $query2) {
                     $select->where('etudiant_id', $query1)
                          ->where('module_id', $query2);
                })->count();
               
              
                if($count!=1){
                     $query = DB::table('notes')->insert(

                [ 'etudiant_id'=>$query1,
                'module_id'=>$query2,  
                'C1' => $request->c1,
                'C2' => $request->c2]
            );
    
    $message1="les données sont ajoutées avec succés !";
 
    $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,notes,users,niveaux,semestres
    WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
    and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
    and users.id=etudiants.user_id and deleted = 0 and notes.etudiant_id=liste_etudiants.etudiant_id and module_id=:idM"), array(
    'idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre,'idM'=>$query2));
   
    return view('Dashboard/professeur/ajouterNotes', ['resultat' =>$resultat,'message1'=>$message1,'idS'=>$idSemestre,'idN'=>$idNiveau,'libelle'=>$libelle]);

  

      
   }
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

                 $resultat = DB::select(DB::raw("SELECT * FROM liste_etudiants,etudiants,notes,users,niveaux,semestres
                 WHERE  semestres.id=:idSe and niveaux.id=:idNi and liste_etudiants.semestre_id=:idS 
                 and liste_etudiants.niveau_id=:idN and liste_etudiants.etudiant_id =etudiants.id 
                 and users.id=etudiants.user_id and deleted = 0 and notes.etudiant_id=liste_etudiants.etudiant_id and module_id=:idM"), array(
                 'idN' => $idNiveau,'idS'=>$idSemestre,'idNi' => $idNiveau,'idSe'=>$idSemestre,'idM'=>$query2));
               
                 return view('Dashboard/professeur/ajouterNotes', ['resultat' =>$resultat,'message1'=>$message1,'idS'=>$idSemestre,'idN'=>$idNiveau,'libelle'=>$libelle]);
             
            
         
                }
            
            
        

      }
}