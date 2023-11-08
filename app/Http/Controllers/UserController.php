<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;

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
}
