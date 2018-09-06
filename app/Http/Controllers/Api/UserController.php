<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
         $user= User::orderBy("id","DESC")->paginate(4);

         return response()->json($user);
    }
    public function  destroy($id){
        ///select * form Users WHERE id = $id;
        $user= User::find($id);
        $user->delete();

        return response()->json('User Delete');

    }
}
