<?php

namespace app\controller\v1;

use app\controller\Controller;
use app\model\createtableModel;

class createtableController extends Controller {

    private $createtable;

    public function __construct($route = null) {
        $this->createtable = new createtableModel();
        parent::__construct($route);
    }

    public function read($id = null) {
        $create = $this->createtable->create();
        $populate = $this->createtable->populate();
    }

}
