<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;

class EditController extends Controller
{
    //la fonction qui affiche la à l'admin un formulaire pour modifier un professeur
    public function showEditProf($id){
        $user= Auth::user();
        $prof_id = $id;
        $profUser = DB::table('professeurs')->select('user_id')->where('id',$prof_id)->get()->get(0);
        
        if(!isset($profUser->user_id)){
            return redirect('/dashboard/adminProfesseur');
        }
        //on récupere les information du professeur
        $prof = DB::table('users')->select('nom','prenom','tel','id')->where('id',$profUser->user_id)->get()->get(0);

        if(!isset($prof)){
            return redirect('/dashboard/adminProfesseur');
        }

        return view('Dashboard/admin/editProf',['user'=>$user,'prof'=>$prof,'prof_id'=>$prof_id]);
    }



    //la fonction qui édite un professeur
    public function editProf(Request $request){
        $user= Auth::user();
        $prof_id = $request->prof_id;
        $profUser = $request->user_id;
        //on change les informations du professeur
        $count =  DB::table('users')->where('id', $profUser)
        ->update([
            'nom' => $request->nomProf,
            'prenom' =>$request->prenomProf,
            'tel' =>$request->telProf,
            ]);
            
    //on recupere les nouvelles informations du professeur
      $prof = DB::table('users')->select('nom','prenom','tel','id')->where('id',$profUser)->get()->get(0);

    if($count == 0){
        $message3 = " Vous n'avez rien changé!";
        return view('Dashboard/admin/editProf',['user'=>$user,'prof'=>$prof,'prof_id'=>$prof_id,'message3'=>$message3]);
    }
    elseif($count != 1){
   
         $message = " Un probléme est servenu, veuillez réessayer!";
         return view('Dashboard/admin/editProf',['user'=>$user,'prof'=>$prof,'prof_id'=>$prof_id,'message'=>$message]);
     
    }else{
        $message2 = " ce compte est edité avec succès!";
        return view('Dashboard/admin/editProf',['user'=>$user,'prof'=>$prof,'prof_id'=>$prof_id,'message2'=>$message2]);
       
    }
    
}



//la fonction qui affiche un formulaire à l'admin pour modifier un étudiant
public function showEditEtud($id){
    $user= Auth::user();

    $etud = DB::table('etudiants')->select('id','cne','code_apogee','adresse','user_id','date_naissance')->where('id',$id)->get()->get(0);

    if(!isset($etud)){
        return redirect('/dashboard/adminEtudiant');
    }
    //on recupere les informations de l'etudiant
    $etudUser = DB::table('users')->select('id','nom','prenom','tel')->where('id',$etud->user_id)->get()->get(0);

    if(!isset($etudUser)){
        return redirect('/dashboard/adminEtudiant');
    }

    return view('Dashboard/admin/editEtud',compact('user'),['etud'=>$etud,'etudUser'=>$etudUser]);
}


//la fonction qui modifie l'étudiant
public function editEtud(Request $request){
    $user= Auth::user();
    $etud_id = $request->etud_id;
  
    $user_id = $request->user_id;
    //on change les informations de l'étudiant
        $count =  DB::table('users')->where('id', $user_id)
        ->update([
            'nom' => $request->nomEtud,
            'prenom' =>$request->prenomEtud,
            'tel' =>$request->telEtud,
            ]);

         $count1 =  DB::table('etudiants')->where('id', $etud_id)
         ->update([
              'cne' => $request->cneEtud,
              'code_apogee' =>$request->code_apogeeEtud,
              'adresse' =>$request->adresseEtud,
              'date_naissance' =>$request->date_naissanceEtud,
              ]);
            
              //on recupere les nouvelles informations
              $etud = DB::table('etudiants')->select('id','cne','code_apogee','adresse','user_id','date_naissance')->where('id',$etud_id)->get()->get(0);
              $etudUser = DB::table('users')->select('id','nom','prenom','tel')->where('id',$etud->user_id)->get()->get(0);

              if($count == 0 && $count1 == 0){
                  $message3 = " Vous n'avez rien changé!";
                 
                return view('Dashboard/admin/editEtud',compact('user'),['etud'=>$etud,'etudUser'=>$etudUser,'message3'=>$message3]);
              }
              elseif($count != 1 && $count1 != 1){
             
                   $message = " Un probléme est servenu, veuillez réessayer!";
                   return view('Dashboard/admin/editEtud',compact('user'),['etud'=>$etud,'etudUser'=>$etudUser,'message'=>$message]);
               
              }else{
                  $message2 = " ce compte est edité avec succès!";
                  return view('Dashboard/admin/editEtud',compact('user'),['etud'=>$etud,'etudUser'=>$etudUser,'message2'=>$message2]);
                 
              }
     
    return redirect('/dashboard/adminEtudiant');
   
}


}