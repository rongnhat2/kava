<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Session;
use Hash;
use DB;

class CustomerRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function get_all()
    {
        return DB::table('customer_auth')
            ->select('customer_auth.*', 'customer_detail.username', 'customer_detail.telephone', 'customer_detail.address', "customer_detail.point", "customer_detail.tier")
            ->leftjoin('customer_detail', 'customer_detail.customer_auth_id', '=', 'customer_auth.id')
            ->selectRaw("(SELECT count(*) FROM customer_proxy WHERE customer_auth.id = customer_proxy.customer_id ) as count_proxy")
            ->selectRaw("(SELECT count(*) FROM customer_proxy LEFT JOIN proxy ON proxy.id = customer_proxy.proxy_id WHERE customer_auth.id = customer_proxy.customer_id AND proxy.status != 4 ) as count_proxy_now")
            ->get();
    }

    public function get_data()
    {
        return DB::table('customer_auth')
            ->select('customer_auth.*', 'customer_detail.username', 'customer_detail.telephone', 'customer_detail.address')
            ->leftjoin('customer_detail', 'customer_detail.customer_auth_id', '=', 'customer_auth.id')
            ->get();
    }
    public function update_trending($id)
    {
        $sql = 'UPDATE customer_auth set view_type = !view_type WHERE id = ' . $id;
        DB::select($sql);
    }

    public function get_one($id)
    {

        return DB::table('customer_auth')
            ->select('customer_auth.*', 'customer_detail.username', 'customer_detail.telephone', 'customer_detail.address', "customer_detail.point", "customer_detail.tier")
            ->leftjoin('customer_detail', 'customer_detail.customer_auth_id', '=', 'customer_auth.id')
            ->selectRaw("(SELECT count(*) FROM customer_proxy WHERE customer_auth.id = customer_proxy.customer_id ) as count_proxy")
            ->selectRaw("(SELECT count(*) FROM customer_proxy LEFT JOIN proxy ON proxy.id = customer_proxy.proxy_id WHERE customer_auth.id = customer_proxy.customer_id AND proxy.status != 4 ) as count_proxy_now")
            ->where("customer_auth.id", "=", $id)
            ->first();
    }

    public function get_user_by_payment_code($payment_code)
    {
        return DB::table("customer_auth")->where("payment_code", "=", $payment_code)->first();
    }
    public function get_detail_by_customer_id($customer_id)
    {
        $customer_detail = DB::table("customer_detail")->where("customer_auth_id", "=", $customer_id)->first();
        return $customer_detail;
    }
    public function get_point_by_customer_id($customer_id)
    {
        $customer_detail = DB::table("customer_detail")->where("customer_auth_id", "=", $customer_id)->first();
        return $customer_detail->point;
    }
    public function increase_point_by_customer_id($customer_id, $new_point)
    {
        DB::table("customer_detail")->where("customer_auth_id", "=", $customer_id)->update([
            "point" => $new_point
        ]);
    }


    public function getOne($id)
    {
        return $this->model->where('id', '=', $id)->get();
    }
    // Kiểm tra Email tồn tại
    public function check_email($email)
    {
        return $this->model->where('email', '=', $email)->first() ? true : false;
    }

    // Tìm customer với Email
    public function find_with_email($email)
    {
        return $this->model->where('email', '=', $email)->first();
    }

    // Tìm customer với Id
    public function find_with_id($id)
    {
        return $this->model->where('customer_auth.id', '=', $id)->leftjoin("customer_detail", "customer_auth.id", "=", "customer_detail.customer_auth_id")->first();
    }

    // Kiểm tra Email / Mật khẩu
    public function checkEmailPassword($request)
    {
        $user = $this->model->where('email', '=', $request->data_email)->first();
        if ($user) {
            return Hash::check($request->data_password, $user->password) ? $user->id : false;
        } else {
            return false;
        }
    }

    // Tạo token client
    public function createTokenClient($id)
    {
        return $id . '$' . Hash::make($id . '$' . $this->model->findOrFail($id)->secret_key);
    }

    // Lấy ra secret_key
    public function get_secret($id)
    {
        return DB::table('customer_auth')
            ->select("secret_key")
            ->where([["id", "=", $id]])
            ->first();
    }

    // Lấy ra Name, Phone, Address 
    public function get_profile($id)
    {
        return DB::table('customer_detail')
            ->select("id", 'username', 'avatar', 'telephone', 'address', 'identity')
            ->where([["customer_detail.customer_auth_id", "=", $id]])
            ->first();
    }
}
