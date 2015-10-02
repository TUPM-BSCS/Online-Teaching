<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use App\User;

use Validator;

class UserController extends Controller
{
    public function change(Request $request, $user_param)
    {
        
        $authuser = \Auth::user();
        if($authuser->role_id==1)
        {
            $redirectTo='main-admin/settings';
        }
        else{
            $redirectTo='institution/settings';
        }
        
        /**Change email form**/
            if($user_param == 'email'){
             $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|email'
            ]);
            if ($validator->fails()) {
                return redirect($redirectTo)
                            ->withErrors($validator)
                            ->withInput()
                            ->with('errortype','email');;
            }
            else{
                $user = User::where('id', $authuser->id)->first();
                $user->email =  $request->input('email');
                $user->save();
                return redirect($redirectTo)->with('status', 'Email Address changed.');
            }
            
        }
        
        /**Change password form**/
        if($user_param =='password'){
            //validates fields
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|min:6',
                'new_password' => 'required|min:6|same:password_confirmation',
                'password_confirmation' => 'required|min:6'
            ]);
    
            if ($validator->fails()) {
                return redirect($redirectTo)
                            ->withErrors($validator)
                            ->with('errortype','password');
            }
            
            $user = User::where('id', \Auth::user()->id)->first();
            
            //checks if current password is correct
            if (! (\Auth::check(bcrypt($request->input('current_password')), \Auth::user()->password)) )
            {
                return redirect($redirectTo)
                            ->withErrors('Current Password is incorrect.')
                            ->withInput()
                            ->with('errortype','password');
            }
            else
            {
                $user->password = bcrypt($request->input('new_password'));
                $user->save();
                return redirect($redirectTo)->with('status', 'Password changed.');
            }    
                    
        }
        
    }
}
