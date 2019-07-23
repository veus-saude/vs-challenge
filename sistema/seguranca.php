<?php

//  Configurações do Script  

// ==============================  
$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?  
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?     
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'     
$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?  
// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.    
$_SG['servidor'] = 'localhost';    // Servidor MySQL  
$_SG['usuario'] = 'veustecc_banco';          // Usuário MySQL  
$_SG['senha'] = 'pbnfn9i8';                // Senha MySQL  
$_SG['banco'] = 'veustecc_banco';            // Banco de dados MySQL   
$_SG['paginaLogin'] = 'login.php'; // Página de login  
$_SG['tabela'] = 'usuarios';       // Nome da tabela onde os usuários são salvos  
// ==============================   
 // ======================================  
 //   ~ Não edite a partir deste ponto ~  
 // ======================================  
   
 // Verifica se precisa fazer a conexão com o MySQL  

if ($_SG['conectaServidor'] == true) {  

$sqli = new mysqli($_SG['servidor'], $_SG['usuario'], $_SG['senha'], $_SG['banco']);

$sqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

}  
if ($_SG['abreSessao'] == true) {  

session_start();  

}

function validaUsuario($usuario, $senha) {  
global $_SG;    
$cS = ($_SG['caseSensitive']) ? 'BINARY' : '';  
// Usa a função addslashes para escapar as aspas  

$nusuario = addslashes($usuario);  
$nsenha = addslashes($senha);     

// Monta uma consulta SQL (query) para procurar um usuário  

$sqli = new mysqli($_SG['servidor'], $_SG['usuario'], $_SG['senha'], $_SG['banco']);

$sqli->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

$sql = "SELECT `id`, `nome` FROM `".$_SG['tabela']."` WHERE ".$cS." `usuario` = '".$nusuario."' AND ".$cS." `senha` = '".$nsenha."' LIMIT 1";  
$query = $sqli->query($sql);  
$resultado = $query->fetch_assoc();  
// Verifica se encontrou algum registro  
if (empty($resultado)) {  
// Nenhum registro foi encontrado => o usuário é inválido  
return false;     
} else {  
// O registro foi encontrado => o usuário é valido    
// Definimos dois valores na sessão com os dados do usuário  
$_SESSION['ID_ADMIN'] = $resultado['id']; // Pega o valor da coluna 'id do registro encontrado no MySQL  
$_SESSION['NOME_ADMIN'] = $resultado['nome']; // Pega o valor da coluna 'nome' do registro encontrado no MySQL    


// Verifica a opção se sempre validar o login  
if ($_SG['validaSempre'] == true) {  
// Definimos dois valores na sessão com os dados do login  
$_SESSION['USER_ADMIN'] = $usuario;  
$_SESSION['SENHA_ADMIN'] = $senha;  
}  
return true;  

}  
}
/**  

* Função que protege uma página  
*/ 
function protegePagina() {  
global $_SG;  
if (!isset($_SESSION['ID_ADMIN']) OR !isset($_SESSION['NOME_ADMIN'])) {  
// Não há usuário logado, manda pra página de login  
expulsaVisitante();  
} else if (!isset($_SESSION['ID_ADMIN']) OR !isset($_SESSION['NOME_ADMIN'])) {  
// Há usuário logado, verifica se precisa validar o login novamente  
if ($_SG['validaSempre'] == true) {  
// Verifica se os dados salvos na sessão batem com os dados do banco de dados  
if (!validaUsuario($_SESSION['USER_ADMIN'], $_SESSION['SENHA_ADMIN'])) {  
// Os dados não batem, manda pra tela de login  
expulsaVisitante();  
}  
}  
}  
}/**  
* Função para expulsar um visitante  
*/ 
/**  
/**  
* Função para expulsar um visitante  
*/ 

function expulsaVisitante() {  
global $_SG;  

 // Remove as variáveis da sessão (caso elas existam)  
unset($_SESSION['ID_ADMIN'], $_SESSION['NOME_ADMIN'], $_SESSION['USER_ADMIN'], $_SESSION['SENHA_ADMIN']);  
// Manda pra tela de login  
header("Location: ".$_SG['paginaLogin']);  

} 

?>
