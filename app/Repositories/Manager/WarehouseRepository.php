<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class WarehouseRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Hàm lấy danh sách phiếu nhập kho, join với bảng nhà cung cấp và chi nhánh để lấy thêm tên
    public function stock_in_get()
    {
        // Lấy tất cả phiếu nhập kho cùng tên nhà cung cấp và tên chi nhánh
        $stock_in = DB::table('warehouses')
            ->select('warehouses.*', 'supplier.name as supplier_name', 'branch.name as branch_name')
            ->join('supplier', 'warehouses.supplier_id', '=', 'supplier.id')
            ->join('branch', 'warehouses.branch_id', '=', 'branch.id')
            ->get();

        return $stock_in;
    }

    // Hàm tạo phiếu nhập kho mới và lưu chi tiết các sản phẩm nhập kho
    public function stock_in_create($request)
    {
        // Chuẩn bị và lưu dữ liệu phiếu nhập kho vào bảng warehouses
        $data = [
            'branch_id' => $request->branch_id,
            'supplier_id' => $request->supplier_id,
            'import_date' => $request->date,
            'total_amount' => $request->total,
            'type' => 1, // loại phiếu: 1 = nhập kho
            'status' => 1, // trạng thái mặc định = hoạt động
        ];

        // Tạo mới phiếu nhập kho, lấy ra ID vừa tạo
        $warehouse_id = DB::table('warehouses')->insertGetId($data);

        // Lấy ra danh sách sản phẩm nhập kho từ metadata
        $metadata = json_decode($request->metadata);

        // Lặp qua từng sản phẩm để lưu vào bảng chi tiết warehouse_detail
        foreach ($metadata as $item) {
            $data = [
                'warehouse_id' => $warehouse_id,
                'product_id' => $item->product, // id sản phẩm
                'quantity' => $item->quantity, // số lượng nhập
                'unit_price' => $item->price, // giá nhập
                'total_price' => $item->total, // tổng giá trị
                'note' => $item->metadata, // ghi chú (nếu có)
            ];
            DB::table('warehouse_detail')->insert($data);
        }
    }
}
