<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){

        $data = User::all()->get();
        return response()->json(['list' => $data,'status' => 'success'], 200);        
    }
}
