<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLogController extends Controller
{
    public function index(){
        $advertisements = Advertisement::all()->where('status', 'На рассмотрении');
        $users = User::all();
        return view('admin', compact('advertisements', 'users'));
    }
    public function create($id){
        Advertisement::where('id', $id) -> update(['status' => 'Одобрено']);
        return back();
    }
    public function destroy($id){
        Advertisement::where('id', $id) -> update(['status' => 'Отклонено']);
        return back();
    }
    public function banned($user){
        User::where('id', $user) -> update(['is_banned'=>1]);
        return back();
    }
    public function unbanned($user){
        User::where('id', $user) -> update(['is_banned'=>0]);
        return back();
    }

}
