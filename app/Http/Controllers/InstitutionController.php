<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Institution;
use App\Professor;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(\Auth::check()){
            if(\Auth::user()->role_id==2){
                $num_verified = collect(DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', true)->where('role_id', 3)
                                        ->get())
                                ->count();
                $num_pending = collect(DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', false)->where('role_id', 3)
                                        ->get())
                                ->count();
                                
                return view('inst_admin.profile', compact('num_verified' , 'num_pending'));
            }               
            else
                return redirect('/'); 
        }
        else   
            return redirect('/'); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        dd(\Auth::check());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
            if(\Auth::user()->role_id==2){
                $is_mainadmin=false;
                $professors_verified = DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', true)->where('role_id', 3)
                                        ->get();
                                        
                $professors_pending = DB::table('professors')
                                        ->join('users', 'users.id', '=', 'professors.user_id')
                                        ->join('institutions','institutions.id', '=' , 'professors.inst_id')
                                        ->where('is_verified', false)->where('role_id', 3)
                                        ->get();
                                        
                $num_verified = collect($professors_verified)->count();
                $num_pending = collect($professors_pending)->count();
                switch($id)
                {
                    case 'professors-verified':
                        $is_verified=true;
                        return view('inst_admin.professor_inst', compact('is_mainadmin', 'is_verified', 'num_pending', 'num_verified', 'professors_verified'));
                        break;
                    case 'professors-pending':
                        $is_verified=false;
                        return view('inst_admin.professor_inst', compact('is_mainadmin', 'is_verified', 'num_pending', 'num_verified', 'professors_pending'));
                        break;
                    case 'courses':
                        return view('admin_shared.courses', compact('is_mainadmin'));
                        break;
                    case 'settings':
                        $email=\Auth::user()->email;
                        return view('admin_shared.settings',compact('is_mainadmin','email', 'num_verified' , 'num_pending'));
                        break;
                    default:
                        return abort(404);
                }
            }
            else
                return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
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
    
    public function accept_prof(Request $request)
    {
        $user = User::where('id', $request->input('prof_id'))->first();
        $user->is_verified = true;
        $user->save();
        return redirect('institution/professors-pending');
    }
    
    public function decline_prof(Request $request)
    {
        $user = User::find($request->input('prof_id'));
        $institution = Professor::where('user_id', $user['id']);
        $user->delete();
        $institution->delete();
        return redirect('institution/professors-pending');
    }
}
