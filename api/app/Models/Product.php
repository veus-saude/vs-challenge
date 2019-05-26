<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brand', 'price', 'amount',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
     ];

    public static function validateProduct(array $data) : \Illuminate\Validation\Validator
    {
    	$rules = [
            'name' => ['required', 'string',
                Rule::unique('products')->where(function ($query) use ($data) {
                    return $query->where('brand', $data['brand'] ?? '');
                })],
            'brand' => 'required|string',
            'price' => 'required|numeric',
            'amount' => 'required|integer'
        ];

        return \Validator::make($data, $rules);
    }

    public function newProduct(array $data) : array
    {
        $validate = self::validateProduct($data);

        if ($validate->fails()){
            $response['messages'] = $validate->messages()->toArray();
            $response['return_code'] = 412;
            return $response;
        }

        $this->fill($data);
        $this->save();

        return ['id' => $this->id, 'return_code' => 201];
    }

    public function updateProduct(int $id, array $data) : array
    {
        $httpCode = 204;
        $product = self::find($id);

        if (empty($product)) {
            return [
                'messages' => ['Not Found'],
                'return_code' => 404
            ];
        }

        $validate = self::validateProduct($data);
        if ($validate->fails()) {
            $response['messages'] = $validate->messages()->toArray();
            $response['return_code'] = 412;
            return $response;
        }

        $product->fill($data);
        $product->save();

        return ['return_code' => $httpCode];
    }

    public function deleteProduct(int $id) : int
    {
        return self::where('id', $id)->delete() ? 204 : 404;
    }

    public function search(array $params)
    {
        $q = $params['q'] ?? '';
        $filtersList = isset($params['filter']) ? explode(',', $params['filter']) : [];
        $sortBy = $params['sort'] ?? '';

        $search = $this->when($q, function ($query, $q) {
                    return $query->where('name', 'like', "%$q%");
                })
                ->when($sortBy, function ($query, $sortBy) {
                    if (in_array($sortBy, $this->fillable)) {
                        return $query->orderBy($sortBy);
                    }
                }, function ($query) {
                    return $query->orderBy('name');
                });

        foreach ($filtersList as $item) {
            list($field,$value) = explode(':', $item);
            if (in_array($field, $this->fillable)) {
                $search->where($field, '=', $value);
            }
        }

        return $search->paginate();
    }
}
