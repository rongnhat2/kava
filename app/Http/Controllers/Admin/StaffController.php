<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Manager\ManagerRepository;
use App\Models\Admin;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class StaffController extends Controller
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin            = new ManagerRepository($admin);
    }
    public function get()
    {
        $admins = $this->admin->get_all();
        return $this->admin->send_response(200, $admins, null);
    }

    public function store(Request $request)
    {
        $admin = $this->admin->create($request);
        return $this->admin->send_response("Success", $admin, 200);
    }
    public function get_one($id)
    {
        $admin = $this->admin->get_one($id);
        return $this->admin->send_response(200, $admin, null);
    }
    public function update(Request $request)
    {
        $admin = $this->admin->update($request);
        return $this->admin->send_response("Success", $admin, 200);
    }
    public function delete($id)
    {
        $admin = $this->admin->delete($id);
        return $this->admin->send_response(200, $admin, null);
    }
}
