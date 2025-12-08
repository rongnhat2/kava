<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class SupplierRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get_all()
    {
        return DB::table('supplier')->get();
    }

    public function get_one($id)
    {
        return DB::table('supplier')
            ->where("id", "=", $id)
            ->first();
    }

    public function create($request)
    {
        $image = $request->data_image;
        $image_url = $this->imageInventor('supplier', $image, 600);
        $data = [
            'name' => $request->data_name,
            'phone' => $request->data_phone,
            'email' => $request->data_email,
            'address' => $request->data_address,
            'image' => $image_url,
        ];
        return DB::table('supplier')->insert($data);
    }

    public function update($request)
    {
        $id = $request->data_id;
        $data = [
            'name' => $request->data_name,
            'phone' => $request->data_phone,
            'email' => $request->data_email,
            'address' => $request->data_address,
        ];
        $image = $request->data_image;
        if ($image != "null" && $image != "undefined" && $image) {
            $image_url = $this->imageInventor('supplier', $image, 600);
            $data['image'] = $image_url;
        }
        return DB::table('supplier')->where('id', $id)->update($data);
    }
    public function delete($id)
    {
        return DB::table('supplier')->where('id', $id)->delete();
    }
}
