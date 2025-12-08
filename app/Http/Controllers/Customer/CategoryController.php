<?php

namespace App\Http\Controllers\Customer;

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
}
