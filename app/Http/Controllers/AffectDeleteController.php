<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AffectDeleteController extends Controller
{
    public function affecter1($id){
        $professeur_id = $id;
       
        return view('Dashboard/admin/affecterModule',compact('professeur_id'));
    }

    public function affecter2(Request $request){
        $professeur_id = $request->professeur_id;
        $niveau_int = $request->niveau;
        $semestre_int = $request->semestre;

        $count = DB::table('annee_univs')->select('id')->where('current',1)->count();
        if($count <= 0 ){
             $message = "Aucune année académique spécifiée!";
             return view('Dashboard/admin/affecterModule',['message'=>$message,'professeur_id'=>$professeur_id]);
        }else{
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
           
            $do = DB::table('enseignes')->select('module_id')->count();
            if($do <= 0){
                $libelle=DB::table('modules')->select('libelle')->get();
                // dd($niveau_id);
                return view('Dashboard/admin/affecterModule2',['professeur_id'=>$professeur_id,
                'niveau_id'=>$niveau_id->id,'semestre_id'=>$semestre_id->id,'libelle'=>$libelle]);
            }
            else{
                $modules = DB::table('enseignes')->select('module_id')->get();
                foreach ($modules as $module) {
                    $data[] = $module->module_id;
                }
   
            $libelle=DB::table('modules')->select('libelle')->whereNotIn('id',$data)->get();
                return view('Dashboard/admin/affecterModule2',['professeur_id'=>$professeur_id,
                'niveau_id'=>$niveau_id->id,'semestre_id'=>$semestre_id->id,'libelle'=>$libelle]);
           
            }
        }
       
    }

    public function affecter3(Request $request){
        $professeur_id = $request->professeur_id;
        $semestre_id = $request->semestre_id;
        $niveau_id = $request->niveau_id;
        $libelle = $request->libelle;

        $count = DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0);
        $do = DB::table('enseignes')
        ->insert([
            'professeur_id' => $professeur_id,
            'niveau_id' => $niveau_id,
            'semestre_id' => $semestre_id,
            'module_id' => $count->id
        ]);

          
        if($do <= 0){
            $message = "un probéme survenu, veuillez rééssayer!";
            return view('Dashboard/admin/affecterModule2',['professeur_id'=>$professeur_id,
            'niveau_id'=>$niveau_id,'semestre_id'=>$semestre_id,'message'=>$message]);
        }
        else{
            $message2 = "l'affectation a été faite avec succès!";
            return view('Dashboard/admin/affecterModule2',['professeur_id'=>$professeur_id,
            'niveau_id'=>$niveau_id,'semestre_id'=>$semestre_id,'message2'=>$message2]);
        }
    
    }


    public function deleteProf($id){

            $count = DB::table('enseignes')->select('id')->where('professeur_id',$id)->count();
        if($count != 0){
            $do = DB::table('enseignes')->where('professeur_id',$id)->delete();
            if($do <= 0){
                return redirect('/dashboard/adminProfesseur');
            }
            else{
                $do2 = DB::table('professeurs')->where('id',$id)
                ->update([
                    'deleted'=> 1,
                ]);
                return redirect('/dashboard/adminProfesseur');
            }
        }
        else{
            $count1 = DB::table('professeurs')->where('id',$id)
            ->update([
                'deleted'=> 1,
            ]);
            return redirect('/dashboard/adminProfesseur');

        }
    }

    
    public function deleteEtud($id){

        $count = DB::table('notes')->select('id')->where('etudiant_id',$id)->count();
        if($count != 0){
            $do = DB::table('notes')->where('etudiant_id',$id)->delete();
            if($do <= 0){
                return redirect('/dashboard/adminEtudiant');
            }
            else{
                $count1 = DB::table('liste_etudiants')->select('id')->where('etudiant_id',$id)->count();
                if($count1 != 0){
                    $do1 = DB::table('liste_etudiants')->where('etudiant_id',$id)->delete();
                    if($do1 <= 0){
                        return redirect('/dashboard/adminEtudiant');
                    }
                    else{
                        $do2 = DB::table('etudiants')->where('id',$id) 
                        ->update([
                            'deleted'=> 1,
                        ]);

                        return redirect('/dashboard/adminEtudiant');
                    }

                }
               
            }
        }
        else{
            $count2 = DB::table('liste_etudiants')->select('id')->where('etudiant_id',$id)->count();
          
            if($count2 != 0){
                $do3 = DB::table('liste_etudiants')->where('etudiant_id',$id)->delete();
                if($do3 <= 0){
                    return redirect('/dashboard/adminEtudiant');
                }
                else{
                    $do4 = DB::table('etudiants')->where('id',$id) 
                    ->update([
                        'deleted'=> 1,
                    ]);

                    return redirect('/dashboard/adminEtudiant');
                }

            }
            else{
                $do5 = DB::table('etudiants')->where('id',$id) 
                ->update([
                    'deleted'=> 1,
                ]);

                return redirect('/dashboard/adminEtudiant');
            }

        }
    }


}
