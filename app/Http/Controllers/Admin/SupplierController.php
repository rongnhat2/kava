<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Manager\SupplierRepository;
use App\Models\Supplier;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class SupplierController extends Controller
{
    protected $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier            = new SupplierRepository($supplier);
    }
    public function get()
    {
        $suppliers = $this->supplier->get_all();
        return $this->supplier->send_response(200, $suppliers, null);
    }

    public function store(Request $request)
    {
        $supplier = $this->supplier->create($request);
        return $this->supplier->send_response("Success", $supplier, 200);
    }
    public function get_one($id)
    {
        $supplier = $this->supplier->get_one($id);
        return $this->supplier->send_response(200, $supplier, null);
    }
    public function update(Request $request)
    {
        $supplier = $this->supplier->update($request);
        return $this->supplier->send_response("Success", $supplier, 200);
    }
    public function delete($id)
    {
        $supplier = $this->supplier->delete($id);
        return $this->supplier->send_response(200, $supplier, null);
    }
}
