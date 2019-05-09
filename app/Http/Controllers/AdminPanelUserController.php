<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminPanelUserController extends Controller
{
    public function index()
    {
        return view('admin.users.index')
            ->with(['users' => User::with('roles')->get()]);
    }
}
