<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{
    public function index(){
        return view('auth/passwords/check');
    }

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
         if($n != 1){
             $message_error = "Informations de connexion invalides. Veuillez réessayez";
             return view('auth/passwords/check',compact('message_error'));
         }
         else{
             $user = DB::table('etudiants')->select('user_id')->where(function ($query) use ($dateBirth, $code, $cne) {
                 $query->where('cne', $cne)
                     ->where('code_apogee', $code)
                     ->where('date_naissance', $dateBirth);
             })->get();

//             dd($user);

             if($user->get(0)->user_id <= 0){
                 $message_error = "Informations de connexion invalidesUne erreur s'est produite. Veuillez réessayez";
                 return view('auth/passwords/check',compact('message_error'));
             }
             else{
//                 return view('auth/register',compact('id'));
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
