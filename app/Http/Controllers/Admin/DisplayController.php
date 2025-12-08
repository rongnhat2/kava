<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    //
    public function login()
    {
        return view('admin.auth.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function index()
    {
        return view('admin.manager.account.index');
    }
    public function transaction()
    {
        return view('admin.manager.transaction.index');
    }
    public function statistic()
    {
        return view('admin.manager.statistic.index');
    }
}
