<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class CategoryRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function get_all()
    {
        return DB::table('category')->get();
    }

    public function get_one($id)
    {
        return DB::table('category')
            ->where("id", "=", $id)
            ->first();
    }

    public function create($request)
    {
        $data = [
            'name' => $request->data_name,
            'slug' => $this->to_slug($request->data_name),
            'description' => $request->data_description,
        ];
        $image = $request->data_image;
        $image_url = $this->imageInventor('category', $image, 600);
        $data['image'] = $image_url;
        return DB::table('category')->insert($data);
    }

    public function update($request)
    {
        $id = $request->data_id;
        $data = [
            'name' => $request->data_name,
            'slug' => $this->to_slug($request->data_name),
            'description' => $request->data_description,
        ];

        $image = $request->data_image;
        if ($image != "null" && $image != "undefined" && $image) {
            $image_url = $this->imageInventor('category', $image, 600);
            $data['image'] = $image_url;
        }
        return DB::table('category')->where('id', $id)->update($data);
    }
    public function delete($id)
    {
        return DB::table('category')->where('id', $id)->delete();
    }


    public function get_top_6_categories_with_most_products()
    {
        return DB::table('category')
            ->leftJoin('product', 'category.id', '=', 'product.category_id')
            ->select(
                'category.id',
                'category.name',
                'category.slug',
                'category.description',
                'category.image',
                DB::raw('COUNT(product.id) as product_count')
            )
            ->groupBy(
                'category.id',
                'category.name',
                'category.slug',
                'category.description',
                'category.image'
            )
            ->orderByDesc('product_count')
            ->limit(6)
            ->get();
    }
}
