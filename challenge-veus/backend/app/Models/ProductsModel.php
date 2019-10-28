<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Common\AbstractModel;
use App\Common\Json;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'price', 'stock'
    ];

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function register(Request $request)
    {
        $data = (object) $request->all();

        if (!AbstractModel::inputValidate($data, 'products_schema.json')) {
            return response([
                "message" => "There are wrong fields in submission",
                "status" => "error",
                "error" => Json::getValidateErrors()
            ], 400);
        }

        $duplicate = self::notDuplicate($data);
        if ($duplicate) {
            return $duplicate;
        }

        try {
            $datas = [
                "name" => $data->name,
                "brand" => $data->brand,
                "price" => $data->price,
                "stock" => $data->stock
            ];

            $result = self::create($datas);

            return response([
                "message" => "Registry created successfully",
                "status" => "success",
                "data" => $result
            ], 201);
        } catch (\Exception $ex) {
            return response([
                "message" => $ex->getMessage(),
                "status" => "error"
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $data = (object) $request->all();

        if (!AbstractModel::inputValidate($data, 'products_schema.json')) {
            return response([
                "message" => "There are wrong fields in submission",
                "status" => "error",
                "error" => Json::getValidateErrors()
            ], 400);
        }

        try {
            $product = self::find($id);

            if (!$product) {
                return response([
                    "message" => "Product not found",
                    "status" => "error",
                    "data" => []
                ], 200);
            }

            $product->name = $data->name;
            $product->brand = $data->brand;
            $product->price = $data->price;
            $product->stock = $data->stock;

            $product->save();

            return response([
                "message" => "Registry updated successfully",
                "status" => "success",
                "data" => $product
            ], 200);
        } catch (\Exception $ex) {
            return response([
                "message" => $ex->getMessage(),
                "status" => "error"
            ], 400);
        }
    }

    private static function notDuplicate($data)
    {
        $result = self::where('name', $data->name)->first();
        if ($result) {
            return response([
                "message" => "The reported name has already been registered",
                "status" => "error"
            ], 200);
        }
    }
}
