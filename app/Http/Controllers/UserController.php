<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            
        ]);

        $user = User::create($data);


        if ($user) {
            return redirect()->route('viewuser');
        }
    }

    public function viewUserall(){
        $user = User::get();
       
        return view('viewuser',compact('user'));
    }
    
    public function deleteUser($id){
        User::find($id)->delete();
        return redirect()->route('viewuser');
    }

    public function updatePage( $id){
        $user = User::find($id);
        return view('updateuser',compact('user'));
    }

    public function updateUser(Request $request, $id){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            
        ]);
        $user = User::where(['id' => $id])->update([
            'name' => $request['name'],
            'email' => $request['email']
        ]);
        if ($user){
            return redirect()->route('viewuser');
        }

    }
}
