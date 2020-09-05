<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use App\Annee_univ;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{   
    //la fonction qui affiche la page settings.blade
    public function setting(){
        $user= Auth::user();
        return view('Dashboard/admin/setting',compact('user'));
    }


     //la fonction qui affiche les années académiques dans la table annee_univs
    public function annee(){
        $user= Auth::user();

        $count = DB::table('annee_univs')->select('id')->count();
        //si la table annee_univs est vide
        if($count <= 0){
            $message = "Aucune annéé trouvée!";
            return view('Dashboard/admin/setting',['user'=>$user,'message'=>$message]);
        }
        //si la table annee_univs n'est pas vide
        else{
            $annee = DB::table('annee_univs')->select('id','int_annee')->get();
            return view('Dashboard/admin/setting',['user'=>$user,'annee'=>$annee]);
        }
    }


     //la fonction qui definit ou modifie l'année académique actuelle
    public function choose(Request $request){
        $user= Auth::user();

        $count = DB::table('annee_univs')
        ->update([
             'current' => 0,
             ]);
        $id = $request->id;
        //definition de la nouvelle année académique
        $count1 = DB::table('annee_univs')->where('id',$id)
        ->update([
             'current' => 1,
             ]);
             $message2 = "l'année académique a été modifiée avec succès";
             $annee = DB::table('annee_univs')->select('id','int_annee')->get();
             return view('Dashboard/admin/setting',['user'=>$user,'annee'=>$annee,'message2'=>$message2]);
        }


        //la fonction qui ajoute une année académique à la table annee_univs
        public function add(Request $request){
            $user= Auth::user();
            $annee = $request->annee;
           
            $count = DB::table('annee_univs')->select('id')->where('int_annee',$annee)->count();
            //si l'annee existe déjà dans la table annee_univs
            if($count != 0){
                $message3 = "Cette année académique axiste déjà";
                return view('Dashboard/admin/setting',['user'=>$user,'message3'=>$message3]);
            }
            //si l'année n'existe pas dans la table annee_univs 
            else{
                //on ajoute l'année à la table
                $count1 = DB::table('annee_univs')
                ->insert([
                     'int_annee' => $annee,
                     ]);

                     $message4 = "Cette année académique a été ajoutée avec succès";
                     return view('Dashboard/admin/setting',['user'=>$user,'message4'=>$message4]);
            }
        }



        //La fonction qui ajoute un emplois du temps à un niveau et un semestre 
        public function emplois(Request $request)
        {
            $user= Auth::user();
            $niveau_int =$request->niveau;
            $semestre_int = $request->semestre;

            $count = DB::table('annee_univs')->select('id')->where('current',1)->count();
            //si aucune année académique a été spécifiée
            if($count <= 0 ){
                 $messageEmp1 = "Aucune année académique spécifiée!";
                 return view('Dashboard/admin/setting',['user'=>$user,'messageEmp1'=>$messageEmp1]);
            }
            else{
                //on récupére l'année académique
                $annee = DB::table('annee_univs')->select('id')->where('current',1)->get()->get(0);

                $semestre = DB::table('semestres')->where(function ($query) use ($annee, $semestre_int) {
                 $query->where('annee_univ_id', $annee->id)
                 ->where('int_semestre', $semestre_int);
                 })->count();
                 //si le semestre voulu n'existe pas, on l'ajoute!
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
                   
                    $check =DB::table('emplois')->select('id')->where(function ($query) use ($semestre_id, $niveau_id) {
                    $query->where('semestre_id', $semestre_id->id)
                         ->where('niveau_id', $niveau_id->id);
                  })->count();

                //si l'emploi existe déjà => update
               if($check != 0){
                    $do = DB::table('emplois')->where(function ($query) use ($semestre_id, $niveau_id) {
                        $query->where('semestre_id', $semestre_id->id)
                            ->where('niveau_id', $niveau_id->id);
                })->update([
                        'emplois' => $request->file('path')->store('emplois','public' ),
                        'semestre_id'=>$semestre_id->id,
                        'niveau_id'=>$niveau_id->id,
                        'updated_at'=>Carbon::now()
                ]);
                if($do != 1){
                    $messageEmp2 = "Un probléme servenu, veuillez réessayer!";
                    return view('Dashboard/admin/setting',['user'=>$user,'messageEmp1'=>$messageEmp2]);
                }
                else{
                    $messageEmp3 = "l'emplois du temps a été modifié avec succès";
                    
                    return view('Dashboard/admin/setting',['user'=>$user,'messageEmp2'=>$messageEmp3]);
                }

               }
               //si l'emploi n'existe pas => insert
               else{
                  
                $do = DB::table('emplois')->insert([
                    'emplois' => $request->file('path')->store('emplois','public' ),
                    'semestre_id'=>$semestre_id->id,
                    'niveau_id'=>$niveau_id->id,
                    'updated_at'=>Carbon::now()
                ]);
                if($do != 1){
                    $messageEmp2 = "Un probléme servenu, veuillez réessayer!";
                    return view('Dashboard/admin/setting',['user'=>$user,'messageEmp1'=>$messageEmp2]);
                }
                else{
                    $messageEmp3 = "l'emplois du temps a été ajouté avec succès";
                    
                    return view('Dashboard/admin/setting',['user'=>$user,'messageEmp2'=>$messageEmp3]);
                }
               }
            }

            }



// la fonction qui affich un emplois du temps pour un professeur
public function profEmp($semestre,$niveau){
    $user= Auth::user();
    $count = DB::table('annee_univs')->select('id')->where('current',1)->count();
    //si aucune année acémique a été spécifiée
    if($count <= 0 ){
         $message = "Aucune année académique spécifiée!";
         return view('Dashboard/professeur/emplois',['user'=>$user,'message'=>$message]);
    }
    else{
        //on récupére l'année académique
        $annee = DB::table('annee_univs')->select('id')->where('current',1)->get()->get(0);

        $s = DB::table('semestres')->where(function ($query) use ($annee, $semestre) {
         $query->where('annee_univ_id', $annee->id)
         ->where('int_semestre', $semestre);
         })->count();
         //si le semestre n'existe pas => insert
         if($s != 1){
            $count4 =  DB::table('semestres')
            ->insert([
                 'int_semestre' => $semestre,
                 'annee_univ_id' => $annee->id,
                 ]);
                 
            }
          $semestre_id = DB::table('semestres')->select('id')->where(function ($query) use ($annee, $semestre) {
                $query->where('annee_univ_id', $annee->id)
                     ->where('int_semestre', $semestre);
           })->get()->get(0);
           
           $niveau_id = DB::table('niveaux')->select('id')->where('int_niveau',$niveau)->get()->get(0);
       
        
        $check =DB::table('emplois')->select('id')->where(function ($query) use ($semestre_id, $niveau_id) {
            $query->where('semestre_id', $semestre_id->id)
                 ->where('niveau_id', $niveau_id->id);
       })->count();
       //s'il ya aucun emplois ajouté pour ce semestre et ce niveau
       if($check != 1){
            $message2 = "aucun emplois du temps n'été trouvé!";
            return view('Dashboard/professeur/emplois',['user'=>$user,'message'=>$message2]);
       }
       //s'il ya déjà un emplosi ajouté pour ce semestre et ce niveau
       else{
            $resultat =DB::table('emplois')->select('emplois','updated_at')->where(function ($query) use ($semestre_id, $niveau_id) {
                $query->where('semestre_id', $semestre_id->id)
                    ->where('niveau_id', $niveau_id->id);
        })->get()->get(0);

            return view('Dashboard/professeur/emplois',['user'=>$user,'resultat'=>$resultat]);
       }
}
    }



    // la fonction qui affiche un emplois du temps pour un étudiant
    public function etudEmp($semestre,$niveau){
        $user= Auth::user();
        
            //on test si la table empolis contient déjà un emplois ou non pour le semestre et le niveau voulus
            $check =DB::table('emplois')->select('id')->where(function ($query) use ($semestre, $niveau) {
                $query->where('semestre_id', $semestre)
                     ->where('niveau_id', $niveau);
           })->count();
           
           //la table ne contient aucun emplois pour le semestre et le niveau voulus
           if($check != 1){
                $message2 = "aucun emplois du temps n'été trouvé!";
                return view('Dashboard/etudiant/emplois',['user'=>$user,'message'=>$message2]);
           }
           //la table contient un emplois pour le semestre et le niveau voulus
           else{
                $resultat =DB::table('emplois')->select('emplois','updated_at')->where(function ($query) use ($semestre, $niveau) {
                    $query->where('semestre_id', $semestre)
                        ->where('niveau_id', $niveau);
            })->get()->get(0);
        
                return view('Dashboard/etudiant/emplois',['user'=>$user,'resultat'=>$resultat]);
           }
    }
    
        }

