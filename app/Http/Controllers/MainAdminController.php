<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Validator;


class MainAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
     
    public function _construct(){
        $this->middleware('mainadmin');
    }
     
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==1)
                return view('main_admin.index');
            else
                return redirect('/'); 
        }
        else   
            return redirect('/'); 
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==1)
                switch($id)
                {
                    case 'institutions_verified':
                        $institutions = DB::table('users')->where('is_verified', true)->where('role_id', 2)->get();
                        $is_verified=true;
                        return view('main_admin.institutions', compact('is_verified','institutions'));
                        break;
                    case 'institutions_pending':
                        $institutions = DB::table('users')->where('is_verified', false)->where('role_id', 2)->get();
                        $is_verified=false;
                        return view('main_admin.institutions', compact('is_verified','institutions'));
                        break;
                    case 'professors':
                        return view('main_admin.professors');
                        break;
                    case 'courses':
                        return view('main_admin.courses');
                        break;
                    case 'settings':
                        $email=\Auth::user()->email;
                        return view('main_admin.settings',compact('email'));
                        break;
                    default:
                        return abort(404);
                }
            else
                return redirect('/');                 
        }
        else   
            return redirect('/'); 
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function change(Request $request, $field)
    {
        /**Change email form**/
        if($field == 'email'){
            $authuser = \Auth::user();
             $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|email'
            ]);
            if ($validator->fails()) {
                return redirect('main_admin/settings')
                            ->withErrors($validator)
                            ->withInput()
                            ->with('errortype','email');;
            }
            else{
                $user = User::where('id', $authuser->id)->first();
                $user->email =  $request->input('email');
                $user->save();
                return redirect('main_admin/settings')->with('status', 'Email Address changed.');
            }
            
        }
        
        /**Change password form**/
        if($field =='password'){
            //validates fields
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|min:6',
                'new_password' => 'required|min:6|same:password_confirmation',
                'password_confirmation' => 'required|min:6'
            ]);
    
            if ($validator->fails()) {
                return redirect('main_admin/settings')
                            ->withErrors($validator)
                            ->with('errortype','password');
            }
            
            $user = User::where('id', \Auth::user()->id)->first();
            
            //checks if current password is correct
            if (! (\Auth::check(bcrypt($request->input('current_password')), \Auth::user()->password)) )
            {
                return redirect('main_admin/settings')
                            ->withErrors('Current Password is incorrect.')
                            ->withInput()
                            ->with('errortype','password');
            }
            else
            {
                $user->password = bcrypt($request->input('new_password'));
                $user->save();
                return redirect('main_admin/settings')->with('status', 'Password changed.');
            }            
        }
    }
}
