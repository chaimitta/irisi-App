<?php

namespace App\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Session;
use DB;
use \App\Course;
use Storage;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
class ListeCoursController extends Controller
{
    //la fonction qui affiche la list des cours
    public function index($niveau, $libelle)
    {
        $idNiveau = $niveau;
    
        Session::put('idNiveau', $idNiveau);
        Session::put('libelle', $libelle);
        
        $id = DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0);

        $count = DB::table('courses')->select('id')->where('module_id',$id->id)->count();
        //aucun cours ajouté pour ce module
        if($count <= 0){
            $messageErr = "Aucun cours ajouté pour le moment!";
            return view('Dashboard/professeur/listesCours',compact('messageErr'));
        }

        else{
         //on recupere les cours
            $resultat = DB::select(DB::raw("SELECT * FROM courses  WHERE   courses.module_id=:idMod;"), array(
                'idMod' => $id->id
            ));
          
            return view('Dashboard/professeur/listesCours',compact('resultat'));
        }
    }


//la fonction qui affiche le formulaire au professeur pour ajouter un cours
    public function ajout()
    {
        $idN = Session::get('idNiveau');
        $filliere = $idN;
        $module = Session::get('libelle');
        $id = DB::table('modules')->select('id')->where('libelle',$module)->get()->get(0);
        Session::put('idModule', $id);
        return view('Dashboard/professeur/ajouterCours', ['filliere' => $filliere, 'module' => $module]);
    }


    //la fonction qui ajoute un cours pour un module
        public function add(Request $request){

        $libelle =$request->libelle_module;
        $id_niveau = $request->id_niveau;

        $id = DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0);
        //l'insertion du cours
            $do = DB::table('courses')->insert([
                'cours' => $request->file('path')->store('cours','public' ),
                'nomCours' => $request->filename,
                'module_id' =>$id->id,
                'created_at'=>Carbon::now()
            ]);
        if($do != 1){
            $message = "Un probléme servenu, veuillez réessayer!";
            return view('Dashboard/professeur/ajouterCours',['filliere'=>$id_niveau,'module'=>$libelle,'message'=>$message]);
        }
        else{
            $message2 = "le cours a été ajouté avec succès";
            
            return view('Dashboard/professeur/ajouterCours',['filliere'=>$id_niveau,'module'=>$libelle,'message2'=>$message2]);
        }
        }


 //la fonction qui affiche un formulaire au professeur pour modifier un cours
    public function showedit($nomCours){

            $count = DB::table('courses')->select('id','module_id')->where('nomCours',$nomCours)->get()->get(0);
            $module_id = $count->module_id;
            $count1 = DB::table('modules')->select('libelle')->where('id',$module_id)->get()->get(0);
            $id_cours = $count->id;
            $nom_cours = $nomCours;
            $module_libelle = $count1->libelle;
    return view('Dashboard/professeur/editCours',['nom_cours'=>$nomCours,'module'=>$module_libelle]);
    }


//la fonction qui modifie le cours
public function edit(Request $request){
    $nomCours = $request->nomCours;
    $oldnom = $request->oldnom;

    $count = DB::table('courses')->select('id','module_id')->where('nomCours',$oldnom)->get()->get(0);
    $count1 = DB::table('modules')->select('libelle')->where('id',$count->module_id)->get()->get(0);
    $libelle=$count1->libelle;
//on change le cours, le nom et la date de création
   if($request->hasFile('path')){
    $do = DB::table('courses')->where('nomCours',$oldnom)->update([
        'cours' => $request->file('path')->store('cours','public' ),
        'nomCours' => $nomCours,
        'created_at'=>Carbon::now()
    ]);
    if($do != 1){
        $message = "Un probléme servenu, veuillez réessayer!";
        return view('Dashboard/professeur/editCours',['module'=>$libelle,'message'=>$message,'nom_cours'=>$oldnom]);
    }
    else{
        $message2 = "le cours a été edité avec succès";
        
        return view('Dashboard/professeur/editCours',['module'=>$libelle,'message2'=>$message2,'nom_cours'=>$nomCours]);
    }
   }
   //on change seulement le nom et la date de création
   else{
    $do = DB::table('courses')->where('nomCours',$oldnom)->update([
        'nomCours' => $nomCours,
        'created_at'=>Carbon::now()
    ]);
    if($do != 1){
        $message = "Un probléme servenu, veuillez réessayer!";
     
        return view('Dashboard/professeur/editCours',['module'=>$libelle,'message'=>$message,'nom_cours'=>$oldnom]);
    }
    else{
        $message2 = "le cours a été edité avec succès";
     
        return view('Dashboard/professeur/editCours',['module'=>$libelle,'message2'=>$message2,'nom_cours'=>$nomCours]);
    }
   }
}


//la fonction qui supprime un cours
public function delete($id){
   
    $count = DB::table('courses')->select('module_id')->where('id',$id)->get()->get(0);
    Session::put('count',$count->module_id);
    $do = DB::table('courses')->where('id',$id)->delete();
   
        return redirect('/cours2');
       
    }
 

//la fonction qui mettre à jour la liste des cours affichés
public function index2(Request $request)
{
    $count = DB::table('courses')->select('id')->where('module_id',Session::get('count'))->count();
    if($count <= 0){
        $messageErr = "Aucun cours ajouté pour le moment!";
       
        return view('Dashboard/professeur/listesCours',compact('messageErr'));
    }
    else{
     
        $resultat = DB::select(DB::raw("SELECT * FROM courses  WHERE   courses.module_id=:idMod;"), array(
            'idMod' => Session::get('count')
        ));
      
        return view('Dashboard/professeur/listesCours',compact('resultat'));
    }
}



//la fonction qui affiche la liste des cours d'un module à un étudiant
public function showToEtud($libelle){
    $module_id = DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0);
    $do = DB::table('courses')->select('cours','nomCours')->where('module_id',$module_id->id)->count();
    //aucun cours est ajouté 
    if($do <= 0){
        $message = "aucun cours ajouté pour ce module";
        return view('Dashboard/etudiant/listesCours',['message'=>$message]);
    }
    else{
       //on recupere la liste des cours
        $resultat = DB::table('courses')->select('cours','nomCours','created_at')->where('module_id',$module_id->id)->get();
        return view('Dashboard/etudiant/listesCours',['resultat'=>$resultat,]);
        
    }

}

}