<?php

namespace CRMApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CRMApp\User;
use Redirect;

class UserController extends Controller
{
    private $code;

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }
    

    public function activate($code)
    {
        $this->code = $code;
        $users = User::where('code', $code);
        $exist = $users->count();
        $user = $users->first();
        if($exist == 1 and $user->active == 0){
            $id = $user->id;
            return view('auth.date_complete', compact('id'));
        }else{
            return redirect::to('/');
        }
    }

    
    public function complete(Request $request, $id){
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->active = 1;
        $user->save();
        return redirect::to('/login');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
