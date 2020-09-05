<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{
    //la fonction qui affiche la page de vérification
    public function index(){
        return view('auth/passwords/check');
    }


    //la fonction qui vérifie les informations données par l'etudiant
    protected function validator(Request $request)
    {
         $cne = $request->cne;
         $code = $request->code;
         $dateBirth = $request->dateBirth;

         $n = DB::table('etudiants')->where(function ($query) use ($dateBirth, $code, $cne) {
             $query->where('cne', $cne)
                 ->where('code_apogee', $code)
                 ->where('date_naissance', $dateBirth);
         })->count();
         //les inforamtions données ne correspond à aucun étudiant
         if($n != 1){
             $message_error = "Informations de connexion invalides. Veuillez réessayez";
             return view('auth/passwords/check',compact('message_error'));
         }
         //les inforamtions données correspond à un étudiant
         else{
             $user = DB::table('etudiants')->select('user_id','deleted')->where(function ($query) use ($dateBirth, $code, $cne) {
                 $query->where('cne', $cne)
                     ->where('code_apogee', $code)
                     ->where('date_naissance', $dateBirth);
             })->get();

             if($user->get(0)->user_id <= 0){
                 $message_error = "Informations de connexion invalides,Une erreur s'est produite. Veuillez réessayez";
                 return view('auth/passwords/check',compact('message_error'));
             }
             //le compte a été supprimé par l'admin
             else{
                 if($user->get(0)->deleted !=0){
                    $message_error2 = "Votre compte a été supprimé. Veuillez contacter l'administrateur!";
                    return view('auth/passwords/check',compact('message_error2'));
                 }
                 //on passe à l'inscription
                 else{

                     $id = $user->get(0)->user_id;
    
                     $user = DB::table('users')->select('nom', 'prenom')->where('id', $id)->get();
                     $nom = $user->get(0)->nom . ' ' . $user->get(0)->prenom;
    
                     Session::put('user_id', $id);
                     Session::put('nom', $nom);
                     return redirect('/register');
                 }

             }
         }
    }
}
