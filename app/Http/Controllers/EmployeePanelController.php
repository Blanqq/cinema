<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeePanelController extends Controller
{
    public function index()
    {
        return view('employee.panel');
    }
}
