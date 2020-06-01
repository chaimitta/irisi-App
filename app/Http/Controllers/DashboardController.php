<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Auth;

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
        return view('Dashboard/etudiant',compact('user'));

    }

}
