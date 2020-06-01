<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{
    public function index(){
        return view('auth/passwords/check');
    }

    protected function validator(array $data)
    {
         Validator::make($data, [
            'cne' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dateBirth' => ['required', 'string', 'max:255','unique:users']
        ]);
         dd($data->cne);
    }

    public function validateCne(){
        dd('It works');
    }
}
