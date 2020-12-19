<?php

namespace App\Http\Controllers\ApiDocumentation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class MainController
 * @package App\Http\Controllers\Api
 */
class MainController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * MainController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = "API " . env("APP_NAME");
        $messagesErrors = messageErrors();
        return view($this->request->route()->getName(), compact("title", "messagesErrors"));
    }

}
