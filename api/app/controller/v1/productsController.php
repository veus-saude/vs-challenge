<?php

namespace app\controller\v1;

use app\controller\Controller;
use app\model\convertModel;
use app\model\productsModel;
use app\model\validateModel;

class productsController extends Controller {

    private $convert;
    private $products;
    private $validate;

    public function __construct($route = null) {
        $this->convert = new convertModel();
        $this->products = new productsModel();
        $this->validate = new validateModel();
        parent::__construct($route);
    }

    public function create() {
        parse_str(file_get_contents("php://input"), $formData);
        $requerido = $this->validate->obrigatoriedadeCampos($formData, 'produto');
        if ($requerido['status']) {
            $validar = $this->validate->validarCampos($formData);
            if ($validar['status']) {
                $produtos = $this->products->create($formData);
                if ($produtos == 1) {
                    $produtosArray = ['status' => 1];
                } else {
                    $produtosArray = ['status' => 2];
                }
            } else {
                $produtosArray = [
                    'status' => 3,
                    'mensagem' => $validar['mensagem']
                ];
            }
        } else {
            $produtosArray = [
                'status' => 4,
                'mensagem' => $requerido['mensagem']
            ];
        }
        $this->view('return/jsonret', array('dados' => $produtosArray));
    }
    
    public function read() {
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        $search = (isset($_GET['q'])) ? $_GET['q'] : null;
        $filter = (isset($_GET['filter'])) ? $_GET['filter'] : null;
        $order = (isset($_GET['order'])) ? $_GET['order'] : null;
        $page = (isset($_GET['page'])) ? $_GET['page'] : null;
        $limit = (isset($_GET['limit'])) ? $_GET['limit'] : null;
        
        $contatos = $this->products->read($id, $search, $filter, $page, $limit, $order);
        
        $contatosArray = $this->convert->utf8_converter($contatos);

        $this->view('return/json', array('json_data' => $contatosArray));
    }
    
    public function update() {
        $formData = $_POST;
        $requerido = $this->validate->obrigatoriedadeCampos($formData, 'produto');
        if ($requerido['status']) {
            $validar = $this->validate->validarCampos($formData);
            if ($validar['status']) {
                $produtos = $this->products->update($formData, $formData['id']);
                if ($produtos == 1) {
                    $produtosArray = ['status' => 1];
                } else {
                    $produtosArray = ['status' => 2];
                }
            } else {
                $produtosArray = [
                    'status' => 3,
                    'mensagem' => $validar['mensagem']
                ];
            }
        } else {
            $produtosArray = [
                'status' => 4,
                'mensagem' => $requerido['mensagem']
            ];
        }
        $this->view('return/jsonret', array('dados' => $produtosArray));
    }

    public function delete($id = null) {
        if (is_null($id) || empty($id)) {
            $produtosArray = [
                'status' => 3,
                'mensagem' => 'Parâmetro não enviado.'
            ];
        } else {
            $produtos = $this->products->delete($id);
            if ($produtos == 1) {
                $produtosArray = ['status' => 1];
            } else {
                $produtosArray = ['status' => 2];
            }
        }
        $this->view('return/jsonret', array('dados' => $produtosArray));
    }
}
