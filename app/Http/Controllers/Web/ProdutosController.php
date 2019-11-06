<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produtos;
use App\Models\QueryFilter\ProdutosQueryFilter;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    /** @var Produtos */
    protected $produtos;

    /**
     * ProdutosController constructor.
     * @param Produtos $produtos
     */
    public function __construct(Produtos $produtos)
    {
        $this->produtos = $produtos;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filtroFinal = $request->all();

        if ($request->has('filter')) {
            // Separa os parametros por virgula
            $filtrosComPontos = explode(',', $request->get('filter'));

            // Separa os parametros por 2 pontos
            $filtrosSeparados = [];
            foreach ($filtrosComPontos as $filtrosComPonto) {
                $filtrosSeparados[] = explode(':', $filtrosComPonto);
            }

            foreach ($filtrosSeparados as $arrayFiltro) {
                $filtroFinal = array_merge($request->all(), [$arrayFiltro[0] => $arrayFiltro[1]]);
            }
        }

        // Quantidade por página
        $perPage = $request->get('per_page') ?? 5;
        $filtroFinal['per_page'] = $perPage;

        // Aplica filtros
        $queryFilter = new ProdutosQueryFilter($filtroFinal);
        $queryBuilder = $queryFilter->apply();

        // Ordenação
        $sort = $request->get('sortBy') ?? 'nome';
        $direction = $request->get('direction') ?? 'asc';
        $filtroFinal['sortBy'] = $sort;
        $filtroFinal['direction'] = $direction;
        $queryBuilder->orderBy($sort, $direction);

        $produtos = $queryBuilder->paginate($perPage)->appends($filtroFinal);
        return view('produtos', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
