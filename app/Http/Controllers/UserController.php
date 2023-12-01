<?php

namespace App\Http\Controllers;
use Illuminate\Support\Arr;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function import(Request $request)
    {
       $request->validate([
        'file' => 'required',
       ]);
        // return 'hello';
        Excel::import(new UsersImport,request()->file('file'));
        // return back();
        return redirect('/')->with('success', 'Import successfull');
    }

    public function index(Request $request)
    {
    //    $users = User::with('roles')->get();
    //    dd($users);
        $roles = Role::pluck('name','name')->all();
        // dd($roles);
        $users = User::select("*")
        ->whereNotNull('last_seen')
        ->orderBy('last_seen', 'DESC')
        ->paginate(10);
       
        return view('users.index', compact('users','roles'))->with('i',($request->input('page',1) - 1) * 5);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name' , 'name')->all();
        return view('users.create',compact('roles'));
    }
      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
        ->with('success','User created successfully');
       
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::find($id);
       $roles = Role::pluck('name' , 'name')->all();
       $userRole = $user->roles->pluck('name','name')->all();
       return view('users.edit',compact('user','roles','userRole'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
        ->with('success','User updated successfully');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                         ->with('success' , 'User delete successfully');
        
    }

    public function show($id)
    {
       $user = User::find($id);
       return view('users.show',compact('user'));
    }
    // public function change()
    // {
    //      echo "helll";
    //     return view ('users.reset-password');
    // }
    public function resetPassword(Request $request ,$id)
    {
         $request->validate([
            'password' => ['required','string' ,'min:6','max:25'],
        ], [
            'password.required' => 'Password is required'
        ]);
        $user = User::find(auth()->user()->id);
        // $user = Auth::user()->id;
    //  $user =   User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
        // $user=$request->user_id?User::find($request->user_id):Auth::user();
        // dd($user);
        $user->update([
            'password' => Hash::make($request->password),
           
        ]);
       return redirect()->back()->with('message', 'Password was update success');
    }
}
