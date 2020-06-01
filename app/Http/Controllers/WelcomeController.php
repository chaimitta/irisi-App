<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
class WelcomeController extends Controller
{
    public function index(){
        if (Auth::check()){
            return redirect('/dashboard');
        }
        else  return view('welcome');
    }

}
