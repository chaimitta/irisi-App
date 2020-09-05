<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
class WelcomeController extends Controller
{
    
    public function index(){
        //vérifier si le l'utilisateur a laissé la connexion ouverte
        if (Auth::check()){
            return redirect('/dashboard');
        }
        //vérifier si le l'utilisateur a été déconnecté 
        else  return view('welcome');
    }

}
