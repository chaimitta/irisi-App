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
    public function index(Request $request)
    {
        $idNiveau = $request->idNiveau;
        $libelle  = $request->libelleModule;
    
        Session::put('idNiveau', $idNiveau);
        Session::put('libelle', $libelle);
        
        $id = DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0);

        $count = DB::table('courses')->select('id')->where('module_id',$id->id)->count();
        if($count <= 0){
            $messageErr = "Aucun cours ajouté pour le moment!";
            return view('Dashboard/professeur/listesCours',compact('messageErr'));
        }
        else{
         
            $resultat = DB::select(DB::raw("SELECT * FROM courses  WHERE   courses.module_id=:idMod;"), array(
                'idMod' => $id->id
            ));
          
            return view('Dashboard/professeur/listesCours',compact('resultat'));
        }
    }
    public function ajout()
    {

        $idN = Session::get('idNiveau');
        $filliere = $idN;
        $module = Session::get('libelle');
        $id = DB::table('modules')->select('id')->where('libelle',$module)->get()->get(0);
        Session::put('idModule', $id);
        return view('Dashboard/professeur/ajouterCours', ['filliere' => $filliere, 'module' => $module]);
    }

        public function add(Request $request)
    {

        $libelle =$request->libelle_module;
        $id_niveau = $request->id_niveau;

        $id = DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0);
        
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
 
public function showedit($nomCours){

$count = DB::table('courses')->select('id','module_id')->where('nomCours',$nomCours)->get()->get(0);
$module_id = $count->module_id;
$count1 = DB::table('modules')->select('libelle')->where('id',$module_id)->get()->get(0);
$id_cours = $count->id;
$nom_cours = $nomCours;
$module_libelle = $count1->libelle;
return view('Dashboard/professeur/editCours',['nom_cours'=>$nomCours,'module'=>$module_libelle]);
}

public function edit(Request $request){
    $nomCours = $request->nomCours;
    $oldnom = $request->oldnom;

    $count = DB::table('courses')->select('id','module_id')->where('nomCours',$oldnom)->get()->get(0);
    $count1 = DB::table('modules')->select('libelle')->where('id',$count->module_id)->get()->get(0);
    $libelle=$count1->libelle;

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

public function delete($id){
   
    $count = DB::table('courses')->select('module_id')->where('id',$id)->get()->get(0);
   

    Session::put('count',$count->module_id);
    $do = DB::table('courses')->where('id',$id)->delete();
   
        return redirect('/cours2');
       
    }
 

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

public function showToEtud($libelle){
    $module_id = DB::table('modules')->select('id')->where('libelle',$libelle)->get()->get(0);
    $do = DB::table('courses')->select('cours','nomCours')->where('module_id',$module_id->id)->count();
    if($do <= 0){
        $message = "aucun cours ajouté pour ce module";
        return view('Dashboard/etudiant/listesCours',['message'=>$message]);
    }
    else{
       
        $resultat = DB::table('courses')->select('cours','nomCours','created_at')->where('module_id',$module_id->id)->get();
        return view('Dashboard/etudiant/listesCours',['resultat'=>$resultat,]);
        
    }

}

}