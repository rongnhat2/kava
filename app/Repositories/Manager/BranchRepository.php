<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class BranchRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function get_all()
    {
        return DB::table('branch')
            ->leftjoin('admin', 'admin.id', '=', 'branch.admin_id')
            ->select('branch.*', 'admin.email as admin_email')
            ->get();
    }

    public function get_one($id)
    {
        return DB::table('branch')
            ->where("id", "=", $id)
            ->first();
    }

    public function create($request)
    {
        $data = [
            'name' => $request->data_name,
            'phone' => $request->data_phone,
            'address' => $request->data_address,
            'admin_id' => $request->data_manager,
        ];
        return DB::table('branch')->insert($data);
    }

    public function update($request)
    {
        $id = $request->data_id;
        $data = [
            'name' => $request->data_name,
            'phone' => $request->data_phone,
            'address' => $request->data_address,
            'admin_id' => $request->data_manager,
        ];
        return DB::table('branch')->where('id', $id)->update($data);
    }
    public function delete($id)
    {
        return DB::table('branch')->where('id', $id)->delete();
    }
}
