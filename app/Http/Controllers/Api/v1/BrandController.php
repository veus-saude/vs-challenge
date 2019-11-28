<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\BrandRequest;
use Illuminate\Http\Request;
use App\Models\Api\v1\Brand;
use Exception;
use Log;

class BrandController extends Controller
{
    
    public $brand;
    
    public function __construct() {
        $this->brand = new Brand();
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $brands = $this->brand->index($request);
            return response()->json($brands);
        } catch (Exception $e) {
            
            $error = json_encode([
                'error'   => 'Erro ao tentar listar marcas',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Não foi possível listar marcas, entre em contato com o suporte Veus'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        try {
            // Get all data from request
            $data = $request->all();
            
            // Insert brand into brands table
            $created = Brand::create($data);
            
            // Return Response
            return response()->json($created);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar cadastrar marca',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar cadastrar marca, entre em contato com o suporte Veus'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Get brand from database into a eloquent object
            $brand = Brand::find($id);
            
            if (!$brand) {
                throw new Exception("Marca não encontrada");
            }
            
            // Return Response
            return response()->json($brand);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar detalhar marca',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar detalhar marca, entre em contato com o suporte Veus'
            ], 500);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        try {
            // Get brand from database into a eloquent object
            $brand = Brand::find($id);
            
            if (!$brand) {
                throw new Exception("Marca não encontrada");
            }
            
            // Get all data from request
            $data = $request->all();
            
            // update brand into brands table
            $brand->update($data);
            
            // Return Response
            return response()->json($brand);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar atualizar marca',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar atualizar marca, entre em contato com o suporte Veus'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Get brand from database into a eloquent object
            $brand = Brand::find($id);
            
            if (!$brand) {
                throw new Exception("Marca não encontrada");
            }
            
            // delete brand from brands table
            $brand->delete();
            
            // Return Response
            return response()->json([
                'success' => true,
                'message' => 'Marca excluída com sucesso'
            ]);
        } catch (Exception $e) {
            $error = json_encode([
                'error'   => 'Erro ao tentar excluir marca',
                'request' => $request->all(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'message' => $e->getMessage()
            ]);
            
            Log::error($error);
            
            return response()->json([
                'success' => false,
                'error'   => 'Erro ao tentar atualizar marca, entre em contato com o suporte Veus'
            ], 500);
        }
    }
}
