<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin;
use Session;
use Hash;
use DB;

class AuthAdmin
{
    public function handle($request, Closure $next, $middleware)
    {
        $token = Session('_token__') ?: $request->cookie('_token__');

        // Helper function to clear token/session and redirect
        $clearTokenAndRedirect = function ($route, $type = 'success', $msg = '') use ($request) {
            $request->session()->forget('_token__');
            Cookie::queue(Cookie::forget('_token__'));
            return redirect()->route($route)->with($type, $msg);
        };

        // Helper function: validate token and return user or null
        $getValidUser = function ($token) {
            if (!$token) return null;
            $parts = explode('$', $token, 2);
            if (count($parts) !== 2) return null;
            list($user_id, $token_value) = $parts;
            $user = DB::table('admin')->where('id', '=', $user_id)->first();
            if (!$user) return null;
            $secret_key = $user->secret_key;
            if (!Hash::check($user_id . '$' . $secret_key, $token_value)) return null;
            return $user;
        };

        if ($middleware === 'auth') {
            if ($token) {
                $user = $getValidUser($token);
                if ($user) {
                    if ($user->status) {
                        // Đã đăng nhập, chuyển hướng về trang admin
                        return redirect()->route('admin.index');
                    } else {
                        return $clearTokenAndRedirect('admin.login', 'error', 'Tài khoản đã bị khóa!');
                    }
                } else {
                    return $clearTokenAndRedirect('admin.login', 'success', 'Tài khoản không tồn tại hoặc token đã hết hạn!');
                }
            }
            return $next($request);
        }

        if ($middleware === 'preview') {
            if ($token) {
                return $next($request);
            }
            return redirect()->route('customer.index');
        }

        // Default: check nếu chưa đăng nhập thì chuyển login
        if ($token) {
            $user = $getValidUser($token);
            if ($user) {
                if ($user->status) {
                    return $next($request);
                } else {
                    return $clearTokenAndRedirect('admin.login', 'error', 'Tài khoản đã bị khóa!');
                }
            } else {
                return $clearTokenAndRedirect('admin.login', 'success', 'Tài khoản không tồn tại hoặc token đã hết hạn!');
            }
        }
        return redirect()->route('admin.login')->with('success', 'Bạn cần đăng nhập để thực hiện hành động này');
    }
}
