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
    //la fonction qui retourne la page monCompte du professeur
    public function prof(){
        $user = Auth::user();
        return view('Dashboard/professeur/profile',compact('user'));
    }

     //la fonction qui retourne la page monCompte de l'admin
    public function admin(){
        $user = Auth::user();
        return view('Dashboard/admin/profile',compact('user'));
    }

     //la fonction qui retourne la page monCompte de l'étudiant
    public function etudiant(){
        $user = Auth::user();
        return view('Dashboard/etudiant/profile',compact('user'));
    }


     //la fonction qui modifie le Compte du professeur
    public function edit(Request $request){
        $user = Auth::user();
        $email = $request->email;
        $pass = $request->pass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
      
        //si un mot de passe a été spécifié
        if ($request->pass != null) {

            //on récupére l'ancien mot de passe du compte
            $password = DB::table('users')->where('id','=',$user->id)
            ->select('password')->get()->get(0)->password;

            //on compare les deux mots de passe => ils sont differents
            if(!Hash::check($request->pass, $password)){
                $passwordincorrect = "l'ancien mot de passe donné est incorrect!";
                return redirect('/register/edit')->with('passwordincorrect',$passwordincorrect);
            }

            //si un nouveau mot de passe a été spécifiée
            if ($request->newpass != null) {

                //si la confirmation du nouveau mot de passe est non nulle
                if($request->confirmpass != null){

                    //si le nouveau mot de passe est sa confirmation sont différents
                    if($request->newpass != $request->confirmpass){
                        $passnotnewpass = "le nouveau mot de passe n'a été pas bien confirmé!";
                        return redirect('/register/edit')->with('passnotnewpass',$passnotnewpass);
                    }

                     //si le nouveau mot de passe est sa confirmation sont égaux => update
                    else{
                            DB::table('users')
                            ->where('id','=',$user->id)
                            ->update([
                                'email' => $request->email,
                                //on change l'ancien mot de passe
                                'password' => Hash::make($request->newpass),
                            ]);
                        
                        //si une image a été ajoutée => on l'ajoute ou on modifie
                        if ($request->hasFile('img')) {
                
                                        $request->validate([
                                          'img' => 'file|image|max:5000',
                                        ]);
                                         $user->update([
                                             'image'=> $request->img->store('uploads','public'),
                                        ]);
                         }
                        $passwordset = "votre compte a été bien modifié!";
                        return redirect('/register/edit')->with('passwordset',$passwordset);

                    }
                }
                //si la confirmation du nouveau mot de passe est nulle!
                else{
                   
                    $passwordconfirmed = "vous devez confirmer le nouveau mot de passe!";
                    return redirect('/register/edit')->with('passwordconfirmed',$passwordconfirmed);
                    
                }

            }
            //si le nouveau mot de passe n'est pas donné
            else{

                $passwordlost = "vous n'avez donné aucun nouveau mot de passe!";
                return redirect('/register/edit')->with('passwordlost',$passwordlost);
            }
        }

        //aucun mot de passe spécifié => on change l'email seulement
        else{
            
                DB::table('users')
                ->where('id','=',$user->id)
                ->update([
                    'email' => $request->email,
                ]);
           
            //si une image a été spécifiée on l'ajoute aussi
            if ($request->hasFile('img')) {
                
                $request->validate([
                  'img' => 'file|image|max:5000',
                ]);
                 $user->update([
                     'image'=> $request->img->store('uploads','public'),
                ]);
 }

            $passwordset = "votre compte a été bien edité!";
            return redirect('/register/edit')->with('passwordset',$passwordset);
        }
    }



    //la fonction qui modifie le compte de l'étudiant
    public function edit2(Request $request){
        $user = Auth::user();
        $email = $request->email;
        $pass = $request->pass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
        
        //si un mot de passe a été spécifié
        if ($request->pass != null) {

            $password = DB::table('users')->where('id','=',$user->id)
            ->select('password')->get()->get(0)->password;

            //si le mot de passe spécifier est différent de l'ancien mot de passe
            if(!Hash::check($request->pass, $password)){
                $passwordincorrect = "l'ancien mot de passe donné est incorrect!";
                return redirect('/register/editEtudiant')->with('passwordincorrect',$passwordincorrect);
            }

            //si un nouveau mot de passe a été spécifié 
            if ($request->newpass != null) {
                //si la confirmation du nouveau mot de passe est non nulle
                if($request->confirmpass != null){

                    //si la confirmation est differente du nouveau mot de passe
                    if($request->newpass != $request->confirmpass){
                        $passnotnewpass = "le nouveau mot de passe n'a été pas bien confirmé!";
                        return redirect('/register/editEtudiant')->with('passnotnewpass',$passnotnewpass);
                    }

                    //on change l'email et l'ancien mot de passe
                    else{
                            DB::table('users')
                            ->where('id','=',$user->id)
                            ->update([
                                'email' => $request->email,
                                'password' => Hash::make($request->newpass),
                            ]);
                       
                        //on ajoute ou on modifie l'image
                        if ($request->hasFile('img')) {
                
                                        $request->validate([
                                          'img' => 'file|image|max:5000',
                                        ]);
                                         $user->update([
                                             'image'=> $request->img->store('uploads','public'),
                                        ]);
                         }
                        $passwordset = "votre compte a été bien modifié!";
                        return redirect('/register/editEtudiant')->with('passwordset',$passwordset);

                    }
                }

                //aucune confirmation spécifiée pour le nouveau mot de passe
                else{
                   
                    $passwordconfirmed = "vous devez confirmer le nouveau mot de passe!";
                    return redirect('/register/editEtudiant')->with('passwordconfirmed',$passwordconfirmed);
                    
                }

            }
            //aucun nouveau mot de passe donné
            else{

                $passwordlost = "vous n'avez donné aucun nouveau mot de passe!";
                return redirect('/register/editEtudiant')->with('passwordlost',$passwordlost);
            }
        }

        //aucun mot de passe donné => on change seulement l'email
        else{
           
                DB::table('users')
                ->where('id','=',$user->id)
                ->update([
                    'email' => $request->email,
                ]);
           
            //on change l'image
            if ($request->hasFile('img')) {
                
                $request->validate([
                  'img' => 'file|image|max:5000',
                ]);
                 $user->update([
                     'image'=> $request->img->store('uploads','public'),
                ]);
 }

            $passwordset = "votre compte a été bien edité!";
            return redirect('/register/editEtudiant')->with('passwordset',$passwordset);
        }
    
    }


//la fonction qui mettre à jour la page monCompte du professeur
    public function update(){
        $util= Auth::user();
       
        $user2 = DB::table('users')->select('id', 'nom','prenom','tel','password','email','categorie','image')->where('id', $util->id)->get();
         $user = $user2->get(0);
        return view('Dashboard/professeur/profile',compact('user'));
    }

    //la fonction qui mettre à jour la page monCompte de l'étudiant
    public function update2(){
        $util= Auth::user();
       
        $user2 = DB::table('users')->select('id', 'nom','prenom','tel','password','email','categorie','image')->where('id', $util->id)->get();
       $user = $user2->get(0);
        return view('Dashboard/etudiant/profile',compact('user'));
    }


//la fonction qui modifie le compte de l'admin
    public function editAdmin(Request $request){
        $user = Auth::user();
        $nom = $request->nom;
        $prenom = $request->prenom;
        $tel = $request->tel;
        $email = $request->email;
        $pass = $request->pass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
        
        //si un mot de passe a été spécifié
        if ($request->pass != null) {

            $password = DB::table('users')->where('id','=',$user->id)
            ->select('password')->get()->get(0)->password;

            //si le mot de passe spécifié est différent de l'ancien mot de passe
            if(!Hash::check($request->pass, $password)){
                $passwordincorrect = "l'ancien mot de passe donné est incorrect!";
                return redirect('/register/editAdmin')->with('passwordincorrect',$passwordincorrect);
            }

            //si un nouveau mot de passe a été spécifié
            if ($request->newpass != null) {

                //si la confirmation n'est pas nulle
                if($request->confirmpass != null){

                    //si la confirmation ne correspont pas au nouveau mot de passe
                    if($request->newpass != $request->confirmpass){
                        $passnotnewpass = "le nouveau mot de passe n'a été pas bien confirmé!";
                        return redirect('/register/editAdmin')->with('passnotnewpass',$passnotnewpass);
                    }
                    //on change les information ainsi que l'ancien mot de passe
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
                        //on change l'image
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
                //le nouveau mot de passe n'été pas confirmé 
                else{
                   
                    $passwordconfirmed = "vous devez confirmer le nouveau mot de passe!";
                    return redirect('/register/editAdmin')->with('passwordconfirmed',$passwordconfirmed);
                    
                }

            }
            //aucun nouveau mot de passe donné
            else{

                $passwordlost = "vous n'avez donné aucun nouveau mot de passe!";
                return redirect('/register/editAdmin')->with('passwordlost',$passwordlost);
            }
        }

        //aucun mot de passe donné => on change seulement les informations
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
            //on change l'image
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


//la fonction qui  mettre à jour la page monCompte de l'admin
    public function updateAdmin(){
        $util= Auth::user();
        
        $user2 = DB::table('users')->select('id', 'nom','prenom','tel','password','email','categorie','image')->where('id', $util->id)->get();
        $user = $user2->get(0);
        return view('Dashboard/admin/profile',compact('user'));
    }

}
