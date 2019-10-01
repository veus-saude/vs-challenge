<?php

namespace App\Http\Controllers;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function list(){
        return $this->rest_response();
    }

    //
    public function detail($id){

    }

    //
    public function create(Request $request){

    }

    //
    public function update($id, Request $request){

    }
    
    //
    public function delete($id){

    }

    
}
