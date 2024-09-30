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
            'name' => 'required|min:3|max:10',
            'email' => 'required|email',
            'phone_number' => 'required|max:10'
        ],
        [

            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters long.',
            'name.max' => 'Name must be at most 10 characters long.',

            'email.required' => 'Email is required.',
            'email.email' => 'Email  is required @ and .com.',

            'phone_number.required' => 'Phone number is required.',
            'phone_number.max' => 'Phone number must be at most 10 characters long.'
        ]
    
    );

        $user = User::create($data);


        if ($user) {
            return redirect()->route('viewuser');
        }
    }

    public function viewUserall(Request $request)
    {


        $user = User::get();
        return view('viewuser', compact('user'));
    }

    // $user = User::get();





    public function deleteUser($id)
    {
        User::find($id)->delete();
        return redirect()->route('viewuser');
    }

    public function updatePage($id)
    {
        $user = User::find($id);
        return view('updateuser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number'=>'required'

        ]);
        $user = User::where(['id' => $id])->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number']
        ]);
        if ($user) {
            return redirect()->route('viewuser');
        }
    }

    public function search(Request $request)
    {
        $output='';
        $search = $request['search'];
        $user = User::where('name', 'LIKE','%'.$search.'%')->get();

        foreach($user as $userItem){
            $output.='<tr>
             <td>'.$userItem->id.'</td>
            <td>'.$userItem->name.'</td>
             <td>'.$userItem->email.'</td>
              <td>'.$userItem->phone_number.'</td>
                  <td><a href="'. route('update.page', $userItem->id).'"
                                    class="btn btn-warning btn-sm">UPDATE</a>
                            </td>
                            <td><a href="'.route('delete', $userItem->id).'"  class="btn btn-danger btn-sm"</a>DELETE</td>
            </tr>';
        }
        return Response($output);
       // return view('viewuser', compact('user'));
    }

    public function index(){
        $user = User::all();
        return view('viewuser', compact('user'));
    }

    // public  function  filter(Request $request){
    //     // $users = User::where('created_at','>',date('Y-m-d', strtotime('-30 days')))->get();
    //     // return view('viewuser', compact('users'));

    //     $start_date = $request->start_date;
    //     $end_date = $request->end_date;

    //     $users = User::whereBetween('created_at', [$start_date, $end_date])->get();
    //     return view('viewuser', compact('users'));
    // }
    public function fetchdatewisedata(Request $request)
    {
        $valid = Request()->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:sdate',
        ]);

       // $start_date = $request->input('start_date');
       // $end_date = $request->input('end_date');

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $user = User::whereBetween('created_at', [$start_date, $end_date])->get();
        return view('viewuser', compact('user'));
    }

}
