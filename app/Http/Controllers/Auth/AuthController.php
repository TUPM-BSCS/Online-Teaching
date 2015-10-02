<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Institution;
use App\Professor;
use Input;
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
    
    public function getLogin($id) { 
        switch($id){
            case 'main-admin':
                $role = 1;
                break;
            case 'institution':
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
        $institutions = Institution::all();
        switch($id){
            case 'institution':
                $role = 2;
                $page ='auth.inst_register';
                break;
            case 'professor':
                $role =3;
                $page = 'auth.prof_register';
                break;
            case 'student':
                $role =4;
                break;
            default:
                return abort(404);
        }
        return view($page, compact('role', 'institutions'));
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
                $page = 'main-admin';
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

        return redirect('/login/'.$page)
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }
    
    protected function institution_validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255|unique:institutions',
            'description' => 'required',
            'contact'=> 'required|digits:7',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);
    }
    
    protected function professor_validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'about' => 'required',
            'institution'=> 'required|max:255|exists:institutions,name',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create_user(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => $data['role_id'],
        ]);
    }
    
    protected function create_institution(array $data)
    {
        return Institution::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'logo' => $data['logo'],
            'contactno' => $data['contact'],
            'admin_id'=> $data['admin_id']
        ]);
    }
    
    protected function create_professor(array $data)
    {
        return Professor::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'description' => $data['about'],
            'image' => $data['image'],
            'inst_id' => $data['inst_id'],
            'user_id' => $data['user_id']
        ]);
    }
    
    public function postInstRegister(Request $request)
    {
        $validator = $this->institution_validator($request->all());
        
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        
        $user = $this->create_user($request->all());
        $user->role_id = 2;
        $user->save();
        
        $credentials = $request->all();
        $credentials['admin_id'] = $user->id;
        $institution = $this->create_institution($credentials);
        
        $imageName = $institution->id.'.'.Input::file('logo')->getClientOriginalExtension();
        Input::file('logo')->move(base_path().'/public/images/institution/', $imageName);
        
        $institution->logo = $imageName."";
        $institution->save();
        
        return redirect('thankyou');
        
    }
    
    public function postProfRegister(Request $request)
    {
        $validator = $this->professor_validator($request->all());
        
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $user = $this->create_user($request->all());
        $user->role_id = 3;
        $user->save();
        
        $credentials = $request->all();
        $credentials['user_id'] = $user->id;
        $institution = Institution::where('name', $request->institution)->first();        
        $credentials['inst_id'] = $institution->id;
        $professor = $this->create_professor($credentials);
        
        $imageName = $professor->id.'.'.Input::file('image')->getClientOriginalExtension();
        Input::file('image')->move(base_path().'/public/images/professor/', $imageName);
        
        $institution->logo = $imageName."";
        $institution->save();
        
        return redirect('thankyou');
    }
   
}
