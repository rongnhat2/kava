<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\AdminRepository;
use App\Models\Admin;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class AuthController extends Controller
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin        = new AdminRepository($admin);
    }

    public function login(Request $request)
    {
        $is_login = $this->admin->checkLogin($request);
        if ($is_login) {
            $token_generate = $this->admin->createToken($request);
            Cookie::queue('_token__', $token_generate, 2628000);
            return $this->admin->send_response("Login Success", '', 200);
        } else {
            return $this->admin->send_response("Email or Password is incorrect", '', 500);
        }
    }
    public function register() {}
    public function logout()
    {
        Cookie::queue(Cookie::forget('_token__'));
        return redirect()->route('admin.login')->with('success', 'Logout Successfully');
    }
}
