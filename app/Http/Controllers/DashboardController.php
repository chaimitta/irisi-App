<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user = Auth::user();
        $categorie = $user->categorie;
        if ($categorie == "1"){
            return view('Dashboard/admin',compact('user'));
        }
        if ($categorie == "2"){
            return view('Dashboard/professeur',compact('user'));
        }

        $studentId = DB::table('etudiants')->select('id')->where('user_id', $user->id)->get();
        $id = $studentId->get(0)->id;

        $results = DB::select( DB::raw("SELECT semestre_id FROM liste_etudiants WHERE etudiant_id = :id_v"), array(
            'id_v' => $id,
        ));
        $semestre_id = $results[0]->semestre_id;

        $modules = DB::select(DB::raw("SELECT * FROM enseignes,modules,semestres,niveaux,professeurs WHERE semestre_id = :id_v and enseignes.module_id = modules.id and enseignes.semestre_id = semestres.id and enseignes.niveau_id = niveaux.id and enseignes.professeur_id = professeurs.id"), array(
            'id_v' => $semestre_id,
        ));

//        dd($modules);

        return view('Dashboard/etudiant',compact('user'),compact('modules'));

    }

}
