<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Requests\V2\EditBrandRequest;
use App\Http\Requests\V2\CreateBrandRequest;
use Illuminate\Http\Request;
use Model\Brand\BrandRepositoryInterface;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    private $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        return $this->successResponse($this->brandRepository->all());
    }

    public function store(CreateBrandRequest $request)
    {
        return $this->successResponse($this->brandRepository->create($request->all()));
    }

    public function show($brand_id)
    {
        return $this->successResponse($this->brandRepository->get($brand_id));
    }

    public function update(EditBrandRequest $request, $brand_id)
    {
        return $this->successResponse($this->brandRepository->update($brand_id,$request->all()));
    }

    public function destroy($brand_id)
    {
        return $this->successResponse((bool) $this->brandRepository->delete($brand_id));
    }
}
