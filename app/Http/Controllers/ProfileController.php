<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function prof(){
        $user = Auth::user();
        return view('Dashboard/professeur/profile',compact('user'));
    }
    public function admin(){
        $user = Auth::user();
        return view('Dashboard/admin/profile',compact('user'));
    }
    public function etudiant(){
        $user = Auth::user();
        return view('Dashboard/etudiant/profile',compact('user'));
    }

    public function edit(Request $request){
        $user = Auth::user();
        $email = $request->email;
        $pass = $request->pass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
      

        $password = DB::table('users')->select('password')->where('id', $user->id)->get();

        $oldpass = $password->get(0)->password;
        
        if(!Hash::check($pass, $oldpass)){
            $message = "Ancien mot de passe invalid";
            return view('Dashboard/professeur/profile',compact('message'),compact('user'));
        }else{

            if($newpass != $confirmpass){
                $message2 = "Informations  invalides,Une erreur s'est produite. Veuillez réessayez";
                return view('Dashboard/professeur/profile',compact('message2'),compact('user'));
            }
            else{
                if ($request->hasFile('img')) {
                
                    $request->validate([
                        'img' => 'file|image|max:5000',
                    ]);
                    $user->update([
                        'image'=> $request->img->store('uploads','public'),
                    ]);
                }
 
                Session::put('email', $email);
                Session::put('password', $newpass);
        
                return redirect('/register/edit');
       
            }
        }
    
    }

    public function edit2(Request $request){
        $user = Auth::user();
        $email = $request->email;
        $pass = $request->pass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
      

        $password = DB::table('users')->select('password')->where('id', $user->id)->get();

        $oldpass = $password->get(0)->password;
        
        if(!Hash::check($pass, $oldpass)){
            $message = "Ancien mot de passe invalid";
            return view('Dashboard/etudiant/profile',compact('message'),compact('user'));
        }else{

            if($newpass != $confirmpass){
                $message2 = "Informations  invalides,Une erreur s'est produite. Veuillez réessayez";
                return view('Dashboard/etudiant/profile',compact('message2'),compact('user'));
            }
            else{
                if ($request->hasFile('img')) {
                
                    $request->validate([
                        'img' => 'file|image|max:5000',
                    ]);
                    $user->update([
                        'image'=> $request->img->store('uploads','public'),
                    ]);
                }
 
                Session::put('email', $email);
                Session::put('password', $newpass);
        
                return redirect('/register/editEtudiant');
       
            }
        }
    
    }



    public function update(){
        $util= Auth::user();
        $count =  DB::table('users')->where('id', $util->id)
            ->update([
            'email' => Session::get('email'),
            'password' => Hash::make(Session::get('password')),
        ]);
        $user2 = DB::table('users')->select('id', 'nom','prenom','tel','password','email','categorie','image')->where('id', $util->id)->get();
       $user = $user2->get(0);
        return view('Dashboard/professeur/profile',compact('user'));
    }

    public function update2(){
        $util= Auth::user();
        $count =  DB::table('users')->where('id', $util->id)
            ->update([
            'email' => Session::get('email'),
            'password' => Hash::make(Session::get('password')),
        ]);
        $user2 = DB::table('users')->select('id', 'nom','prenom','tel','password','email','categorie','image')->where('id', $util->id)->get();
       $user = $user2->get(0);
        return view('Dashboard/etudiant/profile',compact('user'));
    }

    public function editAdmin(Request $request){
        $user = Auth::user();
        $nom = $request->nom;
        $prenom = $request->prenom;
        $tel = $request->tel;
        $email = $request->email;
        $pass = $request->pass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
        

        // $password = DB::table('users')->select('password')->where('id', $user->id)->get();

        // $oldpass = $password->get(0)->password;
        
        // if(!Hash::check($pass, $oldpass)){
        //     $message = "Ancien mot de passe invalid";
        //     return view('Dashboard/admin/profile',compact('message'),compact('user'));
        // }else{

        //     if($newpass != $confirmpass){
        //         $message2 = "Informations  invalides,Une erreur s'est produite. Veuillez réessayez";
        //         return view('Dashboard/admin/profile',compact('message2'),compact('user'));
        //     }
        //     else{
        //         if ($request->hasFile('img')) {
                
        //             $request->validate([
        //                 'img' => 'file|image|max:5000',
        //             ]);
        //             $user->update([
        //                 'image'=> $request->img->store('uploads','public'),
        //             ]);
        //         }
 
        //         Session::put('email', $email);
        //         Session::put('password', $newpass);
        //         Session::put('nom', $nom);
        //         Session::put('prenom', $prenom);
        //         Session::put('tel', $tel);
        
        //         return redirect('/register/editAdmin');
       
        //     }
        // }



        if ($request->pass != null) {

            $password = DB::table('users')->where('id','=',$user->id)
            ->select('password')->get()->get(0)->password;

            if(!Hash::check($request->pass, $password)){
                $passwordincorrect = "l'ancien mot de passe donné est incorrect!";
                return redirect('/register/editAdmin')->with('passwordincorrect',$passwordincorrect);
            }

            if ($request->newpass != null) {
                if($request->confirmpass != null){

                    if($request->newpass != $request->confirmpass){
                        $passnotnewpass = "le nouveau mot de passe n'a été pas bien confirmé!";
                        return redirect('/register/editAdmin')->with('passnotnewpass',$passnotnewpass);
                    }

                    else{

                        if($request->tel != null){

                            DB::table('users')
                            ->where('id','=',$user->id)
                            ->update([
                                'nom' => $request->nom,
                                'prenom' => $request->prenom,
                                'email' => $request->email,
                                'tel' => $request->tel,
                                'password' => Hash::make($request->newpass),
                            ]);
                        }
                        else{
                            DB::table('users')
                            ->where('id','=',$user->id)
                            ->update([
                                'nom' => $request->nom,
                                'prenom' => $request->prenom,
                                'email' => $request->email,
                                'password' => Hash::make($request->newpass),
                            ]);
                        }

                        if ($request->hasFile('img')) {
                
                                        $request->validate([
                                          'img' => 'file|image|max:5000',
                                        ]);
                                         $user->update([
                                             'image'=> $request->img->store('uploads','public'),
                                        ]);
                         }
                        $passwordset = "votre compte a été bien modifié!";
                        return redirect('/register/editAdmin')->with('passwordset',$passwordset);

                    }
                }

                else{
                   
                    $passwordconfirmed = "vous devez confirmer le nouveau mot de passe!";
                    return redirect('/register/editAdmin')->with('passwordconfirmed',$passwordconfirmed);
                    
                }

            }
            else{

                $passwordlost = "vous n'avez donné aucun nouveau mot de passe!";
                return redirect('/register/editAdmin')->with('passwordlost',$passwordlost);
            }
        }
        else{
            if($request->tel != null){
                DB::table('users')
                ->where('id','=',$user->id)
                ->update([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'email' => $request->email,
                    'tel' => $request->tel,
                ]);
            }
            else{

                DB::table('users')
                ->where('id','=',$user->id)
                ->update([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'email' => $request->email,
                ]);
            }

            if ($request->hasFile('img')) {
                
                $request->validate([
                  'img' => 'file|image|max:5000',
                ]);
                 $user->update([
                     'image'=> $request->img->store('uploads','public'),
                ]);
 }

            $passwordset = "votre compte a été bien edité!";
            return redirect('/register/editAdmin')->with('passwordset',$passwordset);
        }
    
    }

    public function updateAdmin(){
        $util= Auth::user();
        // $count =  DB::table('users')->where('id', $util->id)
        //     ->update([
        //     'email' => Session::get('email'),
        //     'password' => Hash::make(Session::get('password')),
        //     'nom' => Session::get('nom'),
        //     'prenom' => Session::get('prenom'),
        //     'tel' => Session::get('tel'),
        // ]);
        $user2 = DB::table('users')->select('id', 'nom','prenom','tel','password','email','categorie','image')->where('id', $util->id)->get();
        $user = $user2->get(0);
        return view('Dashboard/admin/profile',compact('user'));
    }

}
