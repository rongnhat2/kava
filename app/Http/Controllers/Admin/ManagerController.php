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

class ManagerController extends Controller
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin            = new ManagerRepository($admin);
    }

    public function get()
    {
        $admins = $this->admin->get_all();
        return $this->admin->send_response("Success", $admins, 200);
    }
    public function get_transaction()
    {
        $admins = $this->admin->get_transaction();
        return $this->admin->send_response("Success", $admins, 200);
    }
}
