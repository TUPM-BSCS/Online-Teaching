<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
        ]);
    }
    
    public function getLogin($id) {
        switch($id){
            case 'main_admin':
                $role = 1;
                break;
            case 'institution_admin':
                $role = 2;
                break;
            case 'professor':
                $role =3;
                break;
            case 'student':
                $role =4;
                break;
            default:
                return abort(404);
        }
        return view('auth.login', compact('role'));        
    }
    
    public function getRegister($id){
        switch($id){
            case 'institution_admin':
                $role = 2;
                break;
            case 'professor':
                $role =3;
                break;
            case 'student':
                $role =4;
                break;
            default:
                return abort(404);
        }
        return view('auth.register', compact('role'));
    }
    
    public function postLogin(Request $request, $role)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }
        
        $credentials = $this->getCredentials($request);
        $credentials['is_verified'] = true;
        $credentials['role_id'] = $role;
        
        switch($role){
            case 1:
                $page = 'main_admin';
                break;
            case 2:
                $page = 'institution';
                break;
            case 3:
                $page = 'professor';
                break;
            case 4:
                $page = 'student';
                break;
        }

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles, $page);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect('/auth/login/'.$page)
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
    
    public function postRegister(Request $request, $role)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        if($role==4){
            $user = $this->create($request->all());
            $user->is_verified = true;
            $user->save();
            Auth::login($user);
            return redirect('student');
        }
        else{
            if($role==2){
                $user = $this->create($request->all());
                return redirect('thankyou');
            }
            else{
                $user = $this->create($request->all());
                return redirect('thankyou');
            }
        }
        

        
    }
    
}
