<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\TheMovieDB\AuthMovies;
use App\TheMovieDB\GenresMovies;
use App\TheMovieDB\ListMovies;
use App\TheMovieDB\Tokens;
use Illuminate\Http\Request;

class MainController extends Controller
{

    /**
     * @var Request
     */
    protected $request;

    /**
     * RoleController constructor.
     * @param Request $request
     */
    public function __construct
    (
        Request $request
    )
    {
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable|Mixed
     */
    public function index()
    {
        return view($this->request->route()->getName());
    }

}
