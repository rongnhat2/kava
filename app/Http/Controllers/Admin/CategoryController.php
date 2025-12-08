<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Manager\CategoryRepository;
use App\Models\Category;
use Carbon\Carbon;
use Session;
use Hash;
use DB;



class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category            = new CategoryRepository($category);
    }

    public function get()
    {
        $categories = $this->category->get_all();
        return $this->category->send_response(200, $categories, null);
    }

    public function store(Request $request)
    {
        $category = $this->category->create($request);
        return $this->category->send_response("Success", $category, 200);
    }
    public function get_one($id)
    {
        $category = $this->category->get_one($id);
        return $this->category->send_response(200, $category, null);
    }
    public function update(Request $request)
    {
        $category = $this->category->update($request);
        return $this->category->send_response("Success", $category, 200);
    }
    public function delete($id)
    {
        $category = $this->category->delete($id);
        return $this->category->send_response(200, $category, null);
    }
}
