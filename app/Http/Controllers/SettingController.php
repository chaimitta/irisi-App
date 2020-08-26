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
    public function setting(){
        $user= Auth::user();
        return view('Dashboard/admin/setting',compact('user'));
    }

    public function annee(){
        $user= Auth::user();

        $count = DB::table('annee_univs')->select('id')->count();
   
        if($count <= 0){
            $message = "Aucune annéé trouvée!";
            return view('Dashboard/admin/setting',['user'=>$user,'message'=>$message]);
        }
        else{
            $annee = DB::table('annee_univs')->select('id','int_annee')->get();
            return view('Dashboard/admin/setting',['user'=>$user,'annee'=>$annee]);
        }
    }

    public function choose(Request $request){
        $user= Auth::user();

        $count = DB::table('annee_univs')
        ->update([
             'current' => 0,
             ]);
        $id = $request->id;
        
        $count1 = DB::table('annee_univs')->where('id',$id)
        ->update([
             'current' => 1,
             ]);
             $message2 = "l'année académique a été modifiée avec succès";
             $annee = DB::table('annee_univs')->select('id','int_annee')->get();
             return view('Dashboard/admin/setting',['user'=>$user,'annee'=>$annee,'message2'=>$message2]);
        }


        public function add(Request $request){
            $user= Auth::user();
            $annee = $request->annee;
           
            $count = DB::table('annee_univs')->select('id')->where('int_annee',$annee)->count();
            if($count != 0){
                $message3 = "Cette année académique axiste déjà";
                return view('Dashboard/admin/setting',['user'=>$user,'message3'=>$message3]);
            }
            else{
                $count1 = DB::table('annee_univs')
                ->insert([
                     'int_annee' => $annee,
                     ]);

                     $message4 = "Cette année académique a été ajoutée avec succès";
                     return view('Dashboard/admin/setting',['user'=>$user,'message4'=>$message4]);
            }
        }

        public function emplois(Request $request)
        {
            $user= Auth::user();
            $niveau_int =$request->niveau;
            $semestre_int = $request->semestre;

            $count = DB::table('annee_univs')->select('id')->where('current',1)->count();
            if($count <= 0 ){
                 $messageEmp1 = "Aucune année académique spécifiée!";
                 return view('Dashboard/admin/setting',['user'=>$user,'messageEmp1'=>$messageEmp1]);
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
                   
                //    $count = DB::table('niveaux')->select('id')->where('int_niveau','=',$niveau_int)->count();
                   $niveau_id = DB::table('niveaux')->select('id')->where('int_niveau',$niveau_int)->get()->get(0);
               
                //    dd($count);
                
                $check =DB::table('emplois')->select('id')->where(function ($query) use ($semestre_id, $niveau_id) {
                    $query->where('semestre_id', $semestre_id->id)
                         ->where('niveau_id', $niveau_id->id);
               })->count();
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
                    $messageEmp3 = "l'emplois du temps a été ajouté avec succès";
                    
                    return view('Dashboard/admin/setting',['user'=>$user,'messageEmp2'=>$messageEmp3]);
                }

               }
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


public function profEmp($semestre,$niveau){
    $user= Auth::user();
    $count = DB::table('annee_univs')->select('id')->where('current',1)->count();
    if($count <= 0 ){
         $message = "Aucune année académique spécifiée!";
         return view('Dashboard/professeur/emplois',['user'=>$user,'message'=>$message]);
    }
    else{
        $annee = DB::table('annee_univs')->select('id')->where('current',1)->get()->get(0);

        $s = DB::table('semestres')->where(function ($query) use ($annee, $semestre) {
         $query->where('annee_univ_id', $annee->id)
         ->where('int_semestre', $semestre);
         })->count();

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

       if($check != 1){
            $message2 = "aucun emplois du temps n'été trouvé!";
            return view('Dashboard/professeur/emplois',['user'=>$user,'message'=>$message2]);
       }
       else{
            $resultat =DB::table('emplois')->select('emplois','updated_at')->where(function ($query) use ($semestre_id, $niveau_id) {
                $query->where('semestre_id', $semestre_id->id)
                    ->where('niveau_id', $niveau_id->id);
        })->get()->get(0);

            return view('Dashboard/professeur/emplois',['user'=>$user,'resultat'=>$resultat]);
       }
}

    }


    public function etudEmp($semestre,$niveau){
        $user= Auth::user();
        
            
            $check =DB::table('emplois')->select('id')->where(function ($query) use ($semestre, $niveau) {
                $query->where('semestre_id', $semestre)
                     ->where('niveau_id', $niveau);
           })->count();
    
           if($check != 1){
                $message2 = "aucun emplois du temps n'été trouvé!";
                return view('Dashboard/etudiant/emplois',['user'=>$user,'message'=>$message2]);
           }
           else{
                $resultat =DB::table('emplois')->select('emplois','updated_at')->where(function ($query) use ($semestre, $niveau) {
                    $query->where('semestre_id', $semestre)
                        ->where('niveau_id', $niveau);
            })->get()->get(0);
        
                return view('Dashboard/etudiant/emplois',['user'=>$user,'resultat'=>$resultat]);
           }
    }
    
        }

