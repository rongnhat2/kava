<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Traits\ApiRequest;
use Illuminate\Database\Eloquent\Model;
use Image;
use Session;
use Hash;
use DB;
use GuzzleHttp\Client;

abstract class BaseRepository
{
    // # tạo random secret key
    public function generateSecretKey()
    {
        return mt_rand(1000000, 9999999);
    }

    // Fix XSS HTML tag
    public function remove_tag($string)
    {
        $patterns = '/(<([^>]+)>)/i';
        $replacement = "";
        return preg_replace($patterns, $replacement, $string);
    }
    public function send_response($message, $data, $status)
    {
        $res = [
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($res);
    }

    public function imageInventor($folder, $image, $size)
    {
        $input['imagename'] = time() . static::to_reset($image->getClientOriginalName());
        $filePath = public_path($folder);
        $img = Image::make($image->path());
        $img->resize($size, null, function ($const) {
            $const->aspectRatio();
        })->save($filePath . '/' . $input['imagename']);
        return $folder . '/' . $input['imagename'];
    }

    /**
     * Verify user from request token
     * @param Request $request
     * @return int|null User ID if verified, null otherwise
     */
    public function verify_user($request)
    {
        if ($this->check_token($request)) {
            list($user_id, $token) = $this->unpack_token($request);
            return $user_id;
        }
        return null;
    }

    /**
     * Check if token is valid
     * @param Request $request
     * @return bool
     */
    public function check_token($request)
    {
        $token = $request->cookie('_token_');

        if (!$token) {
            return response()->json([
                'status' => 403,
                'data' => null,
                'message' => 'Token không hợp lệ'
            ]);
        }

        list($user_id, $token_hash) = explode('$', $token, 2);
        $user = $this->get_secret($user_id);

        if (!$user) {
            return false;
        }

        return Hash::check($user_id . '$' . $user->secret_key, $token_hash);
    }


    public function get_secret($id)
    {
        return DB::table('customer_auth')
            ->select("secret_key")
            ->where([["id", "=", $id]])
            ->first();
    }

    /**
     * Split token into user ID and hash
     * @param Request $request
     * @return array [$user_id, $token]
     */
    public function unpack_token($request)
    {
        $token = $request->cookie('_token_');
        return explode('$', $token, 2);
    }


    public function to_reset($string)
    {
        $str = trim(mb_strtolower($string));
        $str = preg_replace('/\s+/', '', $str);
        return $str;
    }

    public function to_slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(–)/', ' ', $str);
        $str = preg_replace('/(-)/', ' ', $str);
        $str = preg_replace('/(")/', '', $str);
        $str = preg_replace('/(”)/', '', $str);
        $str = preg_replace('/(“)/', '', $str);
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/(\[|\])/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}
