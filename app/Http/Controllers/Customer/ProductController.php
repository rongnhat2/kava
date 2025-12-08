<?php

namespace App\Http\Controllers\Customer;

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

    public function get_new_product()
    {
        $products = $this->product->get_new_product();
        return $this->product->send_response("Success", $products, 200);
    }
}
