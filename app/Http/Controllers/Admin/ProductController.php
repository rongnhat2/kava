<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Manager\ProductRepository;
use App\Models\Product;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product            = new ProductRepository($product);
    }

    public function get()
    {
        $products = $this->product->get_all();
        return $this->product->send_response("Success", $products, 200);
    }

    public function get_one($id)
    {
        $product = $this->product->get_one($id);
        return $this->product->send_response("Success", $product, 200);
    }

    public function update(Request $request)
    {
        $product = $this->product->update($request);
        return $this->product->send_response("Success", $product, 200);
    }

    public function store(Request $request)
    {
        $product = $this->product->create($request);
        return $this->product->send_response("Success", $product, 200);
    }
}
