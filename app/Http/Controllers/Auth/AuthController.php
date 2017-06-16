<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

/*use Illuminate\Foundation\Auth\AuthenticatesUsers;*/

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/admin/';
    protected $homePath = '/admin/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function authenticate(Request $request)
    {
        if( $request->isMethod('post') == true)
        {   
            //dump($request->all()); die; 

            $this->validate($request,[
                'login' => 'required|max:255',
                'password' => 'required|min:4',
            ]);
            
            $credentials = $request->only('login', 'password');

            if ($request->remember == 'yes') {
                $remember = true;
            }else{
                $remember = false;
            }
           
            
            if(Auth::attempt($credentials, $remember))
            {
               return redirect()->intended($this->redirectPath)->withSuccess('Vous êtes connecté(e)');
               
            }else{
              
              return back()->withInput($request->only('email'))->withErrors('Combinaison login / mot de passe inconnu.'); 
            }
        }

          return view('login');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
