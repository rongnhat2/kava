<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Manager\BranchRepository;
use App\Models\Branch;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class BranchController extends Controller
{
    protected $branch;

    public function __construct(Branch $branch)
    {
        $this->branch            = new BranchRepository($branch);
    }
    public function get()
    {
        $branches = $this->branch->get_all();
        return $this->branch->send_response(200, $branches, null);
    }

    public function store(Request $request)
    {
        $branch = $this->branch->create($request);
        return $this->branch->send_response("Success", $branch, 200);
    }
    public function get_one($id)
    {
        $branch = $this->branch->get_one($id);
        return $this->branch->send_response(200, $branch, null);
    }
    public function update(Request $request)
    {
        $branch = $this->branch->update($request);
        return $this->branch->send_response("Success", $branch, 200);
    }
    public function delete($id)
    {
        $branch = $this->branch->delete($id);
        return $this->branch->send_response(200, $branch, null);
    }
}
