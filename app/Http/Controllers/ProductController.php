<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Utils\QueryStringFilter;

class ProductController extends Controller {
    public function index(Request $request) {
        $qs = new QueryStringFilter($request->all());
        return response()->json($qs->build(Product::query())->get());
    }

    public function show($id) {
        $model = Product::find($id);
        if(!$model) return response()->json(['message' => 'Not found'], 404);
        return response()->json($model);
    }

    public function store(Request $request) {
        $model = new Product();
        $model->fill($request->all());
        $model->save();
        return response()->json($model, 201);
    }

    public function update(Request $request, $id) {
        $model = Product::find($id);
        if(!$model) return response()->json(['message' => 'Not found'], 404);
        $model->fill($request->all());
        $model->save();
        return response()->json($model);
    }

    public function destroy($id) {
        $company = Product::find($id);
        if(!$company) return response()->json(['message' => 'Record not found'], 404);
        $company->delete();
    }
}
