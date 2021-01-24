<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    function index(){
      $user_id = Auth::id();
      $users = User:: where('id', '!=', $user_id)->get();
      return view('dashboard', compact('users'));
    }
}
