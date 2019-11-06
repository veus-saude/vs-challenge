<?php
require_once "Conexao.class.php";

class Login extends Conexao{
	private $conn;
	private $email;
    private $senha;

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
            $cst = $this->conn->conectar()->prepare("SELECT * FROM login;");
            $cst->execute();
            return $cst->fetchAll();
        }catch(PDOException $ex){
            return 'Error: '.$ex->getMessage();
        }
    }

    public function queryInsert($dados){
        try{
            $this->login = $dados['login'];
            $this->senha = md5($dados['senha']);

            $cst = $this->conn->conectar()->prepare("INSERT INTO login (login, senha, status) VALUES ('$this->login', '$this->senha');");

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
            $this->login = $dados['login'];
            $this->senha = md5($dados['senha']);

            $cst = $this->conn->conectar()->prepare("UPDATE login SET login = '$this->login', senha = '$this->senha' WHERE id = $this->id");
              
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
            $cst = $this->conn->conectar()->prepare("DELETE FROM login WHERE id = $this->id;");
            
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error'.$ex->getMessage();
        }
    }

	public function userLogar($dados){
        $this->login = $dados['login'];
        $this->senha = md5($dados['pswd']);
        
        try{
            $cst = $this->conn->conectar()->prepare("SELECT id, login, senha FROM logar WHERE login = '$this->login' AND senha = '$this->senha';");
           
            $cst->execute();
            if($cst->rowCount() == 0){
                header('location: ?login=error');
            }else{
                session_start();
                $rst = $cst->fetch();
                $_SESSION['logado'] = "sim";
                $_SESSION['id'] = $rst['id'];
                $_SESSION['login'] = $rst['login'];
                
                header("location: ../testevs/menu.php");
            }
        }catch(PDOException $e){
            return 'Error: '.$e->getMessage();
        }
    }
        
    public function userLogado($dado){
        $cst = $this->conn->conectar()->prepare("SELECT id, login FROM login WHERE id = $this->id;");
        $cst->execute();
        $rst = $cst->fetch();
        $_SESSION['id'] = $rst['id'];
        $_SESSION['login'] = $rst['login'];
    }

    public function userOut(){
        session_destroy();
        header ('location: http://localhost/testevs/logar.php');
    }
}
?>