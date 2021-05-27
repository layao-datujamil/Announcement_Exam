<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
         return view('admin.index');
        
     }

    public function GetAllUsers(){
            return datatables()->of(User::all())
            ->addColumn('action',function($data){
                $button = '<div class="btn-group btn-group-sm">';
                $button .= '<a href="/users/' . $data->id . '" class="btn btn-info"><i class="fas fa-eye"></i></a>';
                $button .= '<a href="/users/' . $data->id . '/edit" class="btn btn-secondary"><i class="fa fa-edit"></i></a>';
                $button .= '<button class="btn btn-danger" onclick="deleteUser(' . $data->id . ')"><i class="fa fa-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function destroy(User $user){
            $user->delete();
            return response()->json(['success'=> 'User has been deleted.']);
       
    }
    public function show(User $user){
        return view('admin.show',compact('user'));
    }

    public function create(){
        return view('admin.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
        ]);
        
        return redirect('/users')->with('success','User successfully created.');

    }
    public function edit(User $user)
    {
        return view('admin.edit',compact('user'));
    }

    public function update(User $user, UserRequest $request)
    {
       
        $data = $request->validated();
        $pass = '';
        if (Hash::needsRehash($data['password'])){ 
            $pass = Hash::make($data['password']);
        } else{
            $pass = $data['password']; 
        }

        $user->update([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => $pass,
        ]);
            
        return redirect('/users')->with('success','User successfully updated.');
    }
}
