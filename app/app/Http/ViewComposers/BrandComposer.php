<?php

namespace App\http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\BrandRepository;

class BrandComposer
{
    protected $model;

    public function __construct(BrandRepository $model)
    {
        $this->model = $model;
    }

    public function compose(View $view)
    {    
        $view->with('cb_brandById',  $this->model->getAll());
        $view->with('cb_brandByName',  $this->model->getAll());
    }
}