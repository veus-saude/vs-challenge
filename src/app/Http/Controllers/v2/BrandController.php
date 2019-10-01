<?php

namespace App\Http\Controllers\v2;

use App\Brand;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        if ($brands) {
            return response()->json($brands, 200);
        }

        return response()->json(["message" => "Search returned 0 results"], 200);
    }

}
