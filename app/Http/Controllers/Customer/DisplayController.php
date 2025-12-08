<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Repositories\Manager\ProductRepository;
use App\Models\Product;
use App\Repositories\Manager\CategoryRepository;
use App\Models\Category;

class DisplayController extends Controller
{
    protected $product;
    protected $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product            = new ProductRepository($product);
        $this->category            = new CategoryRepository($category);
    }

    public function index()
    {
        return view('customer.index');
    }
    public function product($id, $slug)
    {
        $product = $this->product->customer_get_one($id);
        $product_related = $this->product->customer_get_related($id);
        $product_latest = $this->product->get_latest_three_products();
        $categories = $this->category->get_top_6_categories_with_most_products();
        // dd($categories);
        return view('customer.product', compact('product', 'product_related', 'product_latest', 'categories'));
    }
    public function cart()
    {
        return view('customer.cart');
    }
}
