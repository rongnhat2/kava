<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $profit = DB::table('transaction')->sum('amount');
        $transactions = DB::table('transaction')->count();
        $transaction_data = DB::table('transaction')->get();
        $accounts = DB::table('account')->count();
        return view('admin.manager.statistic.index', compact('profit', 'transactions', 'accounts', 'transaction_data'));
    }
}
