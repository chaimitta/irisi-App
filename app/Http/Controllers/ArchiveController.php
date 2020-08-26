<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function archive()
    {
        $user= Auth::user();
    
        $prof = DB::select(DB::raw("SELECT users.nom,users.prenom,users.tel,users.email,professeurs.id
        FROM users,professeurs
        WHERE  users.id = professeurs.user_id and professeurs.deleted = 1"));

        $etud = DB::select(DB::raw("SELECT users.nom,users.prenom,users.tel,etudiants.id,cne,code_apogee
        FROM users,etudiants
        WHERE  users.id = etudiants.user_id and etudiants.deleted = 1"));
        
        return view('Dashboard/admin/archive',['prof' =>$prof,'etud' =>$etud,'user'=>$user]);
       
    }

    public function showrestoreEtud($id){
        $user= Auth::user();
        $count = DB::table('etudiants')->select('user_id')->where('id',$id)->get()->get(0);
        $etud = DB::table('users')->select('nom','prenom')->where('id',$count->user_id)->get()->get(0);
        
        return view('Dashboard/admin/store',['etudiant_id' =>$id,'user'=>$user,'etud'=>$etud]);
    }

    public function restoreProf($id){
        $user= Auth::user();

        $count = DB::table('professeurs')->where('id',$id)
        ->update([
            'deleted'=> 0,
        ]);
        if($count != 1){
        $message = "Un problème est servenue, veuillez réessayer!";

        $prof = DB::select(DB::raw("SELECT users.nom,users.prenom,users.tel,users.email,professeurs.id
        FROM users,professeurs
        WHERE  users.id = professeurs.user_id and professeurs.deleted = 1"));
   
       $etud = DB::select(DB::raw("SELECT users.nom,users.prenom,users.tel,etudiants.id,cne,code_apogee
       FROM users,etudiants
       WHERE  users.id = etudiants.user_id and etudiants.deleted = 1"));
       
       return view('Dashboard/admin/archive',['message'=>$message,'prof' =>$prof,'etud' =>$etud,'user'=>$user]);
        }
        else{
            $message2 = "le professeur a été restauré avec succès!";

            $prof = DB::select(DB::raw("SELECT users.nom,users.prenom,users.tel,users.email,professeurs.id
            FROM users,professeurs
            WHERE  users.id = professeurs.user_id and professeurs.deleted = 1"));
       
           $etud = DB::select(DB::raw("SELECT users.nom,users.prenom,users.tel,etudiants.id,cne,code_apogee
           FROM users,etudiants
           WHERE  users.id = etudiants.user_id and etudiants.deleted = 1"));
           
           return view('Dashboard/admin/archive',['message2'=>$message2,'prof' =>$prof,'etud' =>$etud,'user'=>$user]);
        }
    }
    

    public function restoreEtud(Request $request){
        $user= Auth::user();
        $niveau_int = $request->niveau;
        $semestre_int = $request->semestre;
        $etudiant_id = $request->etudiant_id;

        $do = DB::table('etudiants')->select('user_id')->where('id',$etudiant_id)->get()->get(0);
        $etud = DB::table('users')->select('nom','prenom')->where('id',$do->user_id)->get()->get(0);
        
        $count = DB::table('annee_univs')->select('id')->where('current',1)->count();
        if($count <= 0 ){
             $message = "Aucune année académique spécifiée!";
             return view('Dashboard/admin/store',['user'=>$user,'message'=>$message,'etud'=>$etud,'etudiant_id'=>$etudiant_id]);
        }
        else{
            $annee = DB::table('annee_univs')->select('id')->where('current',1)->get()->get(0);

            $semestre = DB::table('semestres')->where(function ($query) use ($annee, $semestre_int) {
             $query->where('annee_univ_id', $annee->id)
             ->where('int_semestre', $semestre_int);
             })->count();

             if($semestre != 1){
                $count4 =  DB::table('semestres')
                ->insert([
                     'int_semestre' => $semestre_int,
                     'annee_univ_id' => $annee->id,
                     ]);
                     
                }
              $semestre_id = DB::table('semestres')->select('id')->where(function ($query) use ($annee, $semestre_int) {
                    $query->where('annee_univ_id', $annee->id)
                         ->where('int_semestre', $semestre_int);
               })->get()->get(0);
           
            $niveau_id = DB::table('niveaux')->select('id')->where('int_niveau',$niveau_int)->get()->get(0);
 
            $listEtud = DB::table('liste_etudiants')
            ->insert([
                 'niveau_id' => $niveau_id->id,
                 'semestre_id' => $semestre_id->id,
                 'etudiant_id' => $etudiant_id,
                 ]);

                 $listEtud = DB::table('etudiants')->where('id',$etudiant_id)
                 ->update([
                      'deleted' => 0,
                     
                      ]);
                 $message2 = "l'étudiant a été restauré avec succès!";
                 return view('Dashboard/admin/store',['user'=>$user,'message2'=>$message2,'etud'=>$etud,'etudiant_id'=>$etudiant_id]);
        }
    }



}
