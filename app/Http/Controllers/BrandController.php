<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use App\Services\BrandService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * @var BrandRepository
     */
    private $brandRepository;

    /**
     * BrandController constructor.
     * @param BrandRepository $brandRepository
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        return $this->brandRepository->all();
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        }

        try{
            $brand = $this->brandRepository->create($request->all());
            return \response()->json([
                'status'    => 'success',
                'message'   => 'Marca criada com sucesso.',
                'data'      => $brand
            ]);
        }catch (\Exception $e) {
            return \response()->json([
                'status'    => 'error',
                'message'   => 'Não foi possível criar a marca.',
                'debug'     => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return $validator->errors();
        }

        $brand = $this->brandRepository->update($request->all(), $id);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Marca atualizada com sucesso.',
            'data'      => $brand
        ]);
    }

    public function delete($id)
    {
        $brand = Brand::find($id);

        if(!$brand) {
            return response()->json([
                'status' => 'error',
                'message' => 'A marca que você está tentando excluir, não existe no banco de dados.'
            ], Response::HTTP_NOT_FOUND);
        }

        $brand = $this->brandRepository->delete($id);

        return response()->json([
            'status'    => 'success',
            'message'   => 'Marca removida com sucesso.',
            'data'      => $brand
        ]);
    }
}
