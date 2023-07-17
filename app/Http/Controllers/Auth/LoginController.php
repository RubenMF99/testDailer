<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\loginvalidate;
use App\User;
use App\Persona;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    //public function __construct(){
    //    return $this->middleware('auth');
   // }

    public function login(loginvalidate $request){
    
       
    //    validateLogin($request);
        $url = "error";
       if(Auth::attempt(['email' => $request->usuario,'password' => $request->contrasena,'estado_registro'=>1])){
           $user =  Auth::user()->id;
           $sql = Persona::join('users','personas.id','=','users.id_user')->select('personas.*')->where('users.id','=',$user)->get();
           foreach($sql as $data){
            $request->session()->put('id_persona',$data->id);
            $request->session()->put('nombre',$data->primer_nombre);
            $request->session()->put('imagen', $data->imagen);
            $request->session()->put('correo',$request->usuario);
            }
           if($user2 =  Auth::user()->idrol == 1){
            $url= "/administradores";
           }else if($user2 =  Auth::user()->idrol == 2){
            $url="/home-profesor";
           }else if($user2 =  Auth::user()->idrol == 3){
            $url= "";
           }
            return $url;
        }
        else
        {
            return $url;
        }
       

    }


  

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/');
    }
}
