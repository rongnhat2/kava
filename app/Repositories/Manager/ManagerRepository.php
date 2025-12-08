<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class ManagerRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function get_all()
    {
        return DB::table('account')->get();
    }
    public function get_transaction()
    {
        return DB::table('transaction')->get();
    }
}
