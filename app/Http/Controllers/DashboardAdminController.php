<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DB;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
     public function index()
     {
      $user= Auth::user();
  
     $prof = DB::select(DB::raw("SELECT users.nom,users.prenom,users.tel,users.email,professeurs.id
      FROM users,professeurs
      WHERE  users.id = professeurs.user_id and professeurs.deleted = 0"));
     return view('Dashboard/admin/dashboard',['prof' =>$prof,'user'=>$user]);
        
     }

     public function show(Request $request)
     {
      $user= Auth::user();
      if(request()->niveau){
          $niveau=$request->niveau;

      $resultat = DB::select(DB::raw("select cne,code_apogee,nom,prenom,email,tel,password,etudiants.id,adresse,date_naissance from etudiants,users,liste_etudiants 
      where liste_etudiants.etudiant_id=etudiants.id and liste_etudiants.niveau_id=:niveau and 
      users.id=etudiants.user_id and etudiants.deleted = 0"),array( 'niveau'=>$niveau,));
      
           return view('Dashboard/admin/dashboard2',['user'=>$user,'resultat'=>$resultat,'niveau'=>$niveau]);
        
     }
     return view('Dashboard/admin/dashboard2',['user'=>$user]);
        
     }

     public function showAjoutProf(){
          $user= Auth::user();
          return view('Dashboard/admin/ajouterProf',['user'=>$user]);
     }

     public function ajoutProf(Request $request){
          $user= Auth::user();
        $nom = $request->nom;
        $prenom = $request->prenom;
        $tel = $request->tel;
        $email = $request->email;
        $pass = $request->pass;
        $confirmpass = $request->confirmpass;

        if($pass != $confirmpass){
          $message = "Informations  invalides,Une erreur s'est produite. Veuillez réessayez";
          return view('Dashboard/admin/ajouterProf',compact('message'),compact('user'));
      }
      else{
           $count =  DB::table('users')
           ->insert([
                'email' => $email,
                'password' => Hash::make($pass),
                'nom' => $nom,
                'prenom' => $prenom,
                'tel' => $tel,
                'categorie' => 2,
                ]);
                
                $user2 = DB::table('users')->select('id')->where('email', $email)->get()->get(0);
                
                $count2 =  DB::table('professeurs')
                ->insert([
                     'user_id' => $user2->id,
                     ]);
                     $message2 = "le professeur est ajouté avec succé";
      
      return view('Dashboard/admin/ajouterProf',compact('user'),compact('message2'));
 
      }
  }

  public function showAjoutEtud(){
     $user= Auth::user();
     return view('Dashboard/admin/ajouterEtud',['user'=>$user]);
}

public function ajoutEtud(Request $request){
     $user= Auth::user();
   $nom = $request->nom;
   $prenom = $request->prenom;
   $tel = $request->tel;
   $cne = $request->cne;
   $codeApogee = $request->codeApogee;
   $date = $request->date;
   $adress = $request->adress;
   $niveau = $request->niveau;
   $semestre = $request->semestre;

          $countt = DB::table('annee_univs')->select('id')->where('current',1)->count();
          if($countt <= 0 ){
               $message3 = "Aucune année académique spécifiée!";
               return view('Dashboard/admin/ajouterEtud',compact('user'),compact('message3'));
          }

          else{
               
      $count =  DB::table('users')
      ->insert([
           'nom' => $nom,
           'prenom' => $prenom,
           'tel' => $tel,
           ]);
           
           $user2 = DB::table('users')->select('id')->where(function ($query) use ($nom, $prenom) {
               $query->where('nom', $nom)
                   ->where('prenom', $prenom);
           })->get()->get(0);
           
           $count2 =  DB::table('etudiants')
           ->insert([
                'user_id' => $user2->id,
                'cne' => $cne,
                'code_apogee' => $codeApogee,
                'date_naissance' => $date,
                'adresse' => $adress,
                ]);
          $etudiant_id = DB::table('etudiants')->select('id')->where('user_id',$user2->id)->get()->get(0);
              $annee2 = DB::table('annee_univs')->select('id')->where('current',1)->get()->get(0);

              $semestre2 = DB::table('semestres')->where(function ($query) use ($annee2, $semestre) {
               $query->where('annee_univ_id', $annee2->id)
               ->where('int_semestre', $semestre);
          })->count();
         
          if($semestre2 != 1){
               $count4 =  DB::table('semestres')
               ->insert([
                    'int_semestre' => $semestre,
                    'annee_univ_id' => $annee2->id,
                    ]);
                    
               }
                 $semestre_id = DB::table('semestres')->select('id')->where(function ($query) use ($annee2, $semestre) {
                   $query->where('annee_univ_id', $annee2->id)
                        ->where('int_semestre', $semestre);
              })->get()->get(0);
          
           $niveau_id = DB::table('niveaux')->select('id')->where('int_niveau',$niveau)->get()->get(0);

           $listEtud = DB::table('liste_etudiants')
           ->insert([
                'niveau_id' => $niveau_id->id,
                'semestre_id' => $semestre_id->id,
                'etudiant_id' => $etudiant_id->id,
                ]);

                $message2 = "l'étudiant est ajouté avec succé";
 
 return view('Dashboard/admin/ajouterEtud',compact('user'),compact('message2'));
          }
          

 }

 
 }
     


