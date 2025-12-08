<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class ProductRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    // Lấy tất cả sản phẩm cùng thông tin tên danh mục
    public function get_all()
    {
        // Join với bảng category để lấy tên danh mục của sản phẩm
        return DB::table('product')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->select('product.*', 'category.name as category_name')
            ->get();
    }

    // Lấy thông tin 1 sản phẩm theo id
    public function get_one($id)
    {
        return DB::table('product')
            ->where("id", "=", $id)
            ->first();
    }

    // Hàm thêm mới sản phẩm
    public function create($request)
    {
        $image_list = [];
        // Nếu có danh sách ảnh gửi lên thì xử lý và lưu tên ảnh
        if ($request->image_list_length) {
            for ($i = 0; $i < $request->image_list_length; $i++) {
                array_push($image_list, $this->imageInventor('product', $request['image_list_item_' . $i], 600));
            }
            $data['images'] = implode(",", $image_list); // Gộp các tên ảnh thành 1 chuỗi
        }
        // Lưu các thông tin sản phẩm từ request
        $data['category_id'] = $request->data_category;
        $data['name'] = $request->data_name;
        $data['slug'] = $this->to_slug($request->data_name); // Tạo slug cho tên sản phẩm
        $data['description'] = $request->data_description;
        $data['detail'] = $request->data_detail;
        $data['metadata'] = $request->metadata;
        $data['status'] = 1; // Mặc định trạng thái là 1 = hoạt động

        // Thêm dữ liệu vào bảng product
        return DB::table('product')->insert($data);
    }

    // Cập nhật thông tin sản phẩm
    public function update($request)
    {
        $data['category_id'] = $request->data_category;
        $data['name'] = $request->data_name;
        $data['slug'] = $this->to_slug($request->data_name);
        $data['description'] = $request->data_description;
        $data['detail'] = $request->data_detail;
        $data['metadata'] = $request->metadata;
        $data['status'] = 1;

        $image_list = [];
        // Nếu có ảnh preview cũ thì giữ lại
        if ($request->data_images_preview) {
            $image_preview = explode(",", $request->data_images_preview);
            for ($i = 0; $i < count($image_preview); $i++) {
                array_push($image_list, $image_preview[$i]);
            }
        }
        // Thêm các ảnh mới upload nếu có
        if ($request->image_list_length) {
            for ($i = 0; $i < $request->image_list_length; $i++) {
                $image_name = $this->imageInventor('image-upload', $request['image_list_item_' . $i], 600);
                array_push($image_list, $image_name);
            }
        }
        $data['images'] = implode(",", $image_list); // Gộp các tên ảnh thành 1 chuỗi

        // Cập nhật dữ liệu sản phẩm theo id
        return DB::table('product')->where('id', $request->data_id)->update($data);
    }

    // Xoá sản phẩm theo id
    public function delete($id)
    {
        return DB::table('product')->where('id', $id)->delete();
    }

    // Lấy danh sách 10 sản phẩm mới nhất + danh sách 10 sản phẩm mới cho từng danh mục
    public function get_new_product()
    {
        // Lấy 10 sản phẩm mới nhất
        $all = DB::table('product')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->select('product.*', 'category.name as category_name')
            ->orderBy('product.created_at', 'desc')
            ->limit(10)
            ->get();

        $data = [
            'all' => $all // Lưu tất cả sản phẩm mới vào key 'all'
        ];

        // Lấy toàn bộ danh mục để lấy sản phẩm mới nhất cho từng danh mục
        $categories = DB::table('category')->get();
        foreach ($categories as $category) {
            $data[$category->slug] = DB::table('product')
                ->join('category', 'product.category_id', '=', 'category.id')
                ->select('product.*', 'category.name as category_name')
                ->where('category.slug', $category->slug)
                ->orderBy('product.created_at', 'desc')
                ->limit(10)
                ->get();
        }
        // Trả về mảng tổng hợp tất cả sản phẩm mới và từng danh mục
        return $data;
    }




    // Lấy thông tin 1 sản phẩm theo id
    public function customer_get_one($id)
    {
        return DB::table('product')
            ->where("id", "=", $id)
            ->first();
    }
    // Lấy 4 sản phẩm liên quan theo category_id của product hiện tại (loại trừ chính nó)
    public function customer_get_related($product_id)
    {
        // Lấy sản phẩm hiện tại
        $current = DB::table('product')->where('id', $product_id)->first();
        if (!$current) {
            return collect([]); // Trả về collection rỗng nếu không tìm thấy sp
        }

        // Lấy 4 sản phẩm cùng category, loại trừ chính nó, mới nhất
        $related = DB::table('product')
            ->where('category_id', $current->category_id)
            ->where('id', '!=', $product_id)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return $related;
    }

    // Lấy ra 3 sản phẩm mới thêm vào
    public function get_latest_three_products()
    {
        return DB::table('product')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
    }
}
