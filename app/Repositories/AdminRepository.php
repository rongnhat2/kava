<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Session;
use Hash;
use DB;

class AdminRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function checkLogin($request)
    {
        $user = $this->model->where('email', '=', $request->data_email)->first();
        if ($user) {
            return Hash::check($request->data_password, $user->password) ? $user->id : false;
        } else {
            return false;
        }
    }
    // # Tạo token client
    public function createToken($request)
    {
        $user = $this->model->where('email', '=', $request->data_email)->first();
        return $user->id . '$' . Hash::make($user->id . '$' . $user->secret_key);
    }
}
