<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $user = auth()->user();
        if ($user->restaurant){
            return view('admin.dashboard', compact('user'));
        }else {
            return view('admin.restaurants.create', compact('types'));
        }
    }
}
