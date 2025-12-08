<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Manager\WarehouseRepository;
use App\Models\Warehouse;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class WarehouseController extends Controller
{
    protected $warehouse;

    public function __construct(Warehouse $warehouse)
    {
        $this->warehouse = new WarehouseRepository($warehouse);
    }

    public function stock_in_get()
    {
        $stock_in = $this->warehouse->stock_in_get();
        return $this->warehouse->send_response("Success", $stock_in, 200);
    }
    public function stock_in_create(Request $request)
    {
        $warehouse = $this->warehouse->stock_in_create($request);
        return $this->warehouse->send_response("Success", $warehouse, 200);
    }
}
