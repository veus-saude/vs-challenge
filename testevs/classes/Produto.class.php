<?php
require_once "Conexao.class.php";

class Produto extends Conexao{
	private $conn;

	public function __construct(){
		$this->conn = new Conexao();
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}

	public function __get($atributo){
		return $this->$atributo;
	}

    public function querySelect(){
        try{
            $cst = $this->conn->conectar()->prepare("SELECT * FROM produtos;");
            $cst->execute();
            return $cst->fetchAll();
        }catch(PDOException $ex){
            return 'Error: '.$ex->getMessage();
        }
    }

    public function querySeleciona($dado){
        try{
            $this->id = $_GET['idus'];
            $cst = $this->conn->conectar()->prepare("SELECT * FROM produtos WHERE id = $this->id;");
            $cst->execute();
            return $cst->fetch();
        }catch(PDOException $ex){
            return 'Error: '.$ex->getMessage();
        }
    }

    public function queryInsert($dados){
        try{
            $this->nome = $dados['nome'];
            $this->marca = $dados['marca'];
            $this->preco = $dados['preco'];
            $this->quantidade = $dados['quantidade'];

            $cst = $this->conn->conectar()->prepare("INSERT INTO produtos (nome, marca, preco, quantidade) VALUES ('$this->nome', '$this->marca', replace(replace('$this->preco', '.', ''), ',', '.'), '$this->quantidade');");
            
            if($cst->execute()){               
                return 'ok';
            }else{
                return 'erro';
            }
               
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function queryUpdate($dados){
        try{
            $this->id = $dados['id'];
            $this->nome = $dados['nome'];
            $this->marca = $dados['marca'];
            $this->preco = $dados['preco'];
            $this->quantidade = $dados['quantidade'];

            $cst = $this->conn->conectar()->prepare("UPDATE produtos SET nome = '$this->nome', marca = '$this->marca', preco = replace(replace('$this->preco', '.', ''), ',', '.'), quantidade = '$this->quantidade' WHERE id = $this->id");

            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
            
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }

    public function queryDelete($dado){
        try{
            $this->id = $_GET['idus'];
            $cst = $this->conn->conectar()->prepare("DELETE FROM produtos WHERE id = $this->id;");
            
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error'.$ex->getMessage();
        }
    }

    //PAGINAÇÃO DA LISTA DE PRODUTOS
    public function paginacao($pagina){
        try{
            $html = '';
            // QUANTIDADE DE REGISTRO POR PÁGINA
            $limite = 3;
            // VALOR INICIAL PARA CADA PÁGINA MOSTRAR O REGISTRO
            $inicio = ($limite*$pagina) - $limite;
            // BUSCANDO O TOTAL DE REGISTRO E DIVINDINDO PELO LIMITE DE REGISTRO POR PÁGINA PARA DAR O NÚMERO DE PÁGINAS 
            $ultima_pag = ceil(count($this->querySelect()) / $limite);
            // OPERADOR CONDICIONAL TERNÁRIO
            $get = ($pagina > 1)?('&pag='.$pagina):('');
            $adjacentes = 2;
            // BUSCANDO OS REGISTROS COM INICIO E LIMITE PARA MOSTRAR (DEFAULT)
            $cst = $this->conn->conectar()->prepare("SELECT * FROM produtos ORDER BY nome LIMIT :limite OFFSET :inicio; ");
            
            $cst->bindParam(":inicio", $inicio, PDO::PARAM_INT);
            $cst->bindParam(":limite", $limite, PDO::PARAM_INT);
            $cst->execute();

            // MOSTRANDO OS REGISTRO 5 POR PÁGINA
            $html = '<div class="panel-body">';
                $html .= '<table class="table table-striped">';
                    $html .= '<thead>';
                        $html .= '<tr>';
                            $html .= '<th>Nome</th>';
                            $html .= '<th>Marca</th>';
                            $html .= '<th>Preço</th>';
                            $html .= '<th>Quantidade</th>';
                        $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '<tbody>';
                    foreach($cst->fetchAll() as $rst){
                        $html .= '<tr>';
                            $html .= '<td>'.$rst['nome'].'</td>';
                            $html .= '<td>'.$rst['marca'].'</td>';
                            $html .= '<td>'.'R$ '.number_format($rst['preco'], 2, ',', '.').'</td>';
                            $html .= '<td>'.$rst['quantidade'].'</td>';
                        $html .= '</tr>';
                    }
                    $html .= '</tbody>';
                $html .= '</table>';
            $html .= '</div>';
            // MONTANDO A PÁGINAÇÃO
            $html .= '<nav aria-label="Page navigation" style="height: 65px;">';
                $html .= '<ul class="pagination" style="margin-top: 0px;">';
                
                $cont=1;
                while($cont<=$ultima_pag){
                    if($cont==$pagina){
                        $html.='<li class="active"><a href="?pag='.$cont.'">'.$cont.'<span class="sr-only">(current)</span></a></li>';
                    }else{
                        $html.='<li><a href="?pag='.$cont.'">'.$cont.'</a></li>';
                    }

                $cont++;
                }
            $html.="</ul> </nav>";
          
            //caso não tenha registros      
            if($cst->rowCount() == 0){
                return '<div class="alert alert-info"> Olá! Nenhum cadastro foi registrado no sistema. </div>';
            }else{
                return $html;
            }
            return $html;
        }catch(PDOException $ex){
            return 'Error: '.$ex->getMessage();
        }
    }

    function busca($nome,$marca){
        try{
            $cst = $this->conn->conectar()->prepare("SELECT * FROM produtos
                WHERE nome LIKE '%".$nome."%' or marca LIKE '%".$marca."%'; ");
            $cst->execute();
    
            $html = '<div class="panel-body">';
                $html .= '<table class="table table-striped">';
                    $html .= '<thead>';
                        $html .= '<tr>';
                            $html .= '<th>Nome</th>';
                            $html .= '<th>Marca</th>';
                            $html .= '<th>Preço</th>';
                            $html .= '<th>Quantidade</th>';
                        $html .= '</tr>';
                    $html .= '</thead>';
                    $html .= '<tbody>';
                    foreach($cst->fetchAll() as $rst){
                        $html .= '<tr>';
                            $html .= '<td>'.$rst['nome'].'</td>';
                            $html .= '<td>'.$rst['marca'].'</td>';
                            $html .= '<td>'.'R$ '.number_format($rst['preco'], 2, ',', '.').'</td>';
                            $html .= '<td>'.$rst['quantidade'].'</td>';
                        $html .= '</tr>';
                    }
                    $html .= '</tbody>';
                $html .= '</table>';
            $html .= '</div>';
            
            //caso não tenha registros      
            if($cst->rowCount() == 0){
                return '<div class="alert alert-info"> Olá! Nenhum registrado foi ncontrado no sistema. Realize nova busca, por favor. </div>';
            }else{
                return $html;
            }
        }catch(PDOException $ex){
            return 'Error: '.$ex->getMessage();
        }
    }
}
?>