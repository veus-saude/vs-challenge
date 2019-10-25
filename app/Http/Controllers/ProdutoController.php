<?php

namespace App\Http\Controllers;
use App\Produto;

/* Requests */
use Illuminate\Http\Request;
use App;
use Crypt;

use Auth;
use App\Log;
use Session;

class ProdutoController extends Controller
{  
    
    /**
     *
     * Método: Abre a página de log do sistema  
     * ROUTE: indexLog
     * Requisição: GET
     * @return \Illuminate\View\View  
     *
     * */
    public function getIndexLog() {
        
        // Seleciono todos os registros do log do sistema
        $obj_log = Log::select('id', 'mensagem', 'motivo')
                                    ->orderBy('id', 'DESC')
                                    ->paginate(10);        
        
        if(empty($obj_log)){
            
            //Não encontrou log exibição da view
            return view('log-vazio');
            
        }else{
            
            //encontrou log exibição da view
            return view('index-log')->with('logs', $obj_log);
            
        }
                   
    }
    
    /**
     *
     * Método: Abre página de visualização de um produto específico
     * ROUTE: visualizar-produto/{id}
     * Requisição: GET
     * @param int $id - Código do produto criptografado
     * @return \Illuminate\View\View  
     *
     * */
    public function getVisualizarProduto($id) {
        
        // Decriptanto o código que veio da url
        $codigo_produto = Crypt::decrypt($id);
             
        //realizo a consulta do produto ativo
        $obj_produto = Produto::where('produtos.status', '=', 1)
                                 ->find($codigo_produto);
                
        if(empty($obj_produto)){
            
            // Exibição da View info
            return view('produto-nao-encontrado');

        }else{
            
            // Exibição da View
            return view('visualizar-produto')->with('produtos', $obj_produto);

        }
    }
     
    /**
     *
     * Método: Abre página de cadastro de produto  
     * ROUTE: cadastrar-produto
     * Requisição: GET
     * @return \Illuminate\View\View  
     *
     * */
    public function getCadastrarProduto(Request $request)
    {
        //View de exibição
        return view('cadastrar-produto');
    }

    /**
     *
     * Método: Processamento do formulário cadastrar produto.
     * ROUTE: store
     * Requisição: POST
     * @return true ou false com msg de retorno
     *
     * */
    public function postStore(Request $request){
        
        //Instanciando o objeto 
        $produtoAgregar = new Produto;
        
        //validação de campo oriundo do form
        $request->validate([
            'nome'          => 'required|max:250',
            'marca'         => 'required|max:250',
            'preco'         => 'required|numeric',
            'quantidade'    => 'required|integer',
        ]);
        
        //recuperando valores oriundos do form
        $produtoAgregar->nome = $request->nome;
        $produtoAgregar->marca = $request->marca;
        $produtoAgregar->preco = $request->preco;
        $produtoAgregar->quantidade = $request->quantidade;
        $produtoAgregar->status = 1;
        
        //salvando o produto
        $processaProdutoAgregar = $produtoAgregar->save();
        
        //verificando se o processamento aconteceu
        if($processaProdutoAgregar == true){
        
            /************************************************************  
                  LOGS MONTANDO ESTRUTURA PADRÃO
                  INSERÇÃO DE LOGS (TUDO QUE O USUÁRIO FAZ NO SISTEMA)
                 * ******************************************************* */

                // Definindo o fuso horário por segurança
                date_default_timezone_set('America/Sao_Paulo');
                // Pego o IP
                $ip = $_SERVER['REMOTE_ADDR'];
                // Defino mensagem
                $mensagem = 'Inserção do produto ' . mb_strtoupper($produtoAgregar->nome) . ' . A Ação foi efetuada com o endereço de IP ' . $ip;

                $obj_log = new Log();
                $obj_log->mensagem = $mensagem;
                $obj_log->motivo = 'Cadastro do produto';
                $obj_log->created_at = date('Y-m-d H:i:s');
                $processa_log = $obj_log->save();
                
                //destruindo variáveis              
                unset($produtoAgregar);
                unset($processaProdutoAgregar);
                unset($obj_log);
                unset($processa_log);
                unset($mensagem);
                unset($ip);

            return back()->with('agregar', 'O produto foi salvo corretamente.');
            
        }   
                
    }

    
    /**
     *
     * Método: Abre página de alteração de um produto específico
     * ROUTE: /editar/{id}
     * Requisição: GET
     * @param int $id - Código do produto criptografado
     * @return \Illuminate\View\View  
     *
     * */
    public function getEditar($id)
    {
        // Decriptanto o código que veio da url
        $codigo_produto = Crypt::decrypt($id);
        
        //
        $produtoAtualizar = App\Produto::findOrfail($codigo_produto);
        
        return view('editar', compact('produtoAtualizar'));
    }

    /**
     *
     * Método: Processamento do formulário editar produto.
     * ROUTE: /update/{id}
     * Requisição: POST
     * @return true ou false com msg de retorno
     *
     * */
    public function postUpdate(Request $request, $id){
        
        // Decriptanto o código que veio da url
        $codigo_produto = Crypt::decrypt($id);
        
        //validação de campo oriundo do form
        $request->validate([
            'nome'          => 'required|max:250',
            'marca'         => 'required|max:250',
            'preco'         => 'required|numeric',
            'quantidade'    => 'required|integer',
        ]);
        
        $produtoUpdate = App\Produto::findOrfail($codigo_produto);
        $produtoUpdate->nome = $request->nome;
        $produtoUpdate->marca = $request->marca;
        $produtoUpdate->preco = $request->preco;
        $produtoUpdate->quantidade = $request->quantidade;
        
        $processaProdutoUpdate = $produtoUpdate->save();
        
        if($processaProdutoUpdate == true){
        
            /************************************************************  
                  LOGS MONTANDO ESTRUTURA PADRÃO
                  INSERÇÃO DE LOGS (TUDO QUE O USUÁRIO FAZ NO SISTEMA)
                 * ******************************************************* */

                // Definindo o fuso horário por segurança
                date_default_timezone_set('America/Sao_Paulo');
                // Pego o IP
                $ip = $_SERVER['REMOTE_ADDR'];
                // Defino mensagem
                $mensagem = 'Edição do produto ' . mb_strtoupper($produtoUpdate->nome) . ' . A Ação foi efetuada com o endereço de IP ' . $ip;

                $obj_log = new Log();
                $obj_log->mensagem = $mensagem;
                $obj_log->motivo = 'Alteração do produto';
                $obj_log->created_at = date('Y-m-d H:i:s');
                $processa_log = $obj_log->save();

                //destruindo variáveis
                unset($produtoUpdate);
                unset($processaProdutoUpdate);
                unset($obj_log);
                unset($processa_log);
                unset($mensagem);
                unset($ip);
                
            return back()->with('update', 'O produto foi editado corretamente.');
            
        }           
        
    }

    /**
     *
     * Método: Excluir o produto do banco de dados DELETE
     * ROUTE: /remover-produto/{id}
     * Requisição: POST
     * @return true ou false com msg de retorno
     *
     * */
    public function destroy($id)
    {
        // Decriptanto o código que veio da url
        $codigo_produto = Crypt::decrypt($id);
                
        $produtoRemover = App\Produto::findOrfail($codigo_produto);
        $processaProdutoRemover= $produtoRemover->delete();
        
        if($processaProdutoRemover == true){
        
            /************************************************************  
                  LOGS MONTANDO ESTRUTURA PADRÃO
                  INSERÇÃO DE LOGS (TUDO QUE O USUÁRIO FAZ NO SISTEMA)
                 * ******************************************************* */

                // Definindo o fuso horário por segurança
                date_default_timezone_set('America/Sao_Paulo');
                // Pego o IP
                $ip = $_SERVER['REMOTE_ADDR'];
                // Defino mensagem
                $mensagem = 'Remoção do produto ' . mb_strtoupper($produtoRemover->nome) . ' . A Ação foi efetuada com o endereço de IP ' . $ip;

                $obj_log = new Log();
                $obj_log->mensagem = $mensagem;
                $obj_log->motivo = 'Produto removido';
                $obj_log->created_at = date('Y-m-d H:i:s');
                $processa_log = $obj_log->save();

                //destruindo variáveis
                unset($processaProdutoRemover);
                unset($obj_log);
                unset($processa_log);
                unset($mensagem);
                unset($ip);

            return back()->with('remover-produto', 'O produto foi removido corretamente.');
            
        }    
    }
    
     /**
     *
     * Método: Abre página de inativação de um produto específico do banco de dados.
     * ROUTE: /inativar-produto/{id}
     * Requisição: GET
     * @param int $id - Código do produto criptografado
     * @return \Illuminate\View\View  
     *
     * */
     public function getInativarProduto($id) {

        //decriptando o código que veio na URL
        $codigo_produto = Crypt::decrypt($id);
        
        //instanciando o objeto        
        $obj_produtos = Produto::where('id', '=', $codigo_produto)->where('status', '=', 1)->first(); 
                
        if(empty($obj_produtos)){
            
            //Nenhum produto encontrado Exibição da View info
            return view('produto-nao-encontrado');
            
        }else{
            
            //Produto encontrado exibição da view
            return view('inativar-produto')->with('produto', $obj_produtos)
                                            ->with('codigo_produto', $id);
            
        }

    }
    
    /**
     *
     * Método: Processamento do formulário de inativação de um produto específico do banco de dados.
     * ROUTE: /inativar-produto/
     * Requisição: POST
     * @return true ou false com msg de retorno
     *
     * */
    public function postInativarProduto(Request $request){ 
                
        // Recebendo o cod_produto e decriptando ..
        $codigo_produto = Crypt::decrypt($request->input('cod_produto'));
                
        // Recebendo informações do form
        $motivo = $request->input('motivo');

        //instancio o objeto para atualização
        $obj_produtos = Produto::where('id', '=', $codigo_produto)->where('status', '=', 1)->first();

        if(empty($obj_produtos)){
            
            //Não encontrou produto ativo
            return redirect()->back()->with('error', "Não foi possível inativar este produto. Tente novamente mais tarde!")->withInput($request->all());
            
        }else{
                        
            //Produto ativo encontrado
            
            //pego o status antigo
            $status_old = $obj_produtos->status;

            //Mascarando o status ANTIGO para guardar em log de [x] para [y]
            if ($status_old == 0){
                //status recebe
                $status_antigo = "inativo";

            } elseif ($status_old == 1) {
                //status recebe
                $status_antigo = "ativo";
            }

            // inativo o produto na TABELA PRODUTO
            $obj_produtos->status = 0;
            $obj_produtos->updated_at = date('Y-m-d H:i:s');

            //salvando o status
            $processa = $obj_produtos->save();

            //verificando se houve erro na inserção
            if (!$processa){
                //retorno da mensagem
                return redirect()->back()->with('error', "Não foi possível inativar este produto. Tente novamente mais tarde!")->withInput($request->all());

            }else{

                /************************************************************  
                  LOGS MONTANDO ESTRUTURA PADRÃO
                  INSERÇÃO DE LOGS (TUDO QUE O USUÁRIO FAZ NO SISTEMA)
                 * ******************************************************* */

                // Mascarando status ATUAL para guardar em log de: [X] para: [Y]
                if ($obj_produtos->status == 1){
                    $status_atual = "ativo";
                }elseif ($obj_produtos->status == 0) {
                    $status_atual = "inativo";
                }
                // Definindo o fuso horário por segurança
                date_default_timezone_set('America/Sao_Paulo');
                // Pego o IP
                $ip = $_SERVER['REMOTE_ADDR'];
                // Defino mensagem
                $mensagem = 'Inativação do produto ' . mb_strtoupper($obj_produtos->nome) . ' . O status desta foi modificado de ' . mb_strtoupper($status_antigo) . ' para ' . mb_strtoupper($status_atual) . ' . A Ação foi efetuada com o endereço de IP ' . $ip;

                $obj_log = new Log();
                $obj_log->mensagem = $mensagem;
                $obj_log->motivo = $motivo;
                $obj_log->created_at = date('Y-m-d H:i:s');
                $processa_log = $obj_log->save();

                //destruindo variáveis
                unset($obj_produtos);
                unset($processa);
                unset($obj_log);
                unset($processa_log);
                unset($mensagem);
                unset($motivo);
                unset($ip);
                unset($status_antigo);
                unset($status_atual);
                unset($codigo_produto);

                // Retorno para a index 
                return redirect('painel')->with('success', "O produto foi inativado com sucesso!");
            
            }
        }
    }
    
    /**
     *
     * Método: Abre a página de listagem dos produtos inativos  
     * ROUTE: indexProdutoInativo
     * Requisição: GET
     * @return \Illuminate\View\View  
     *
     * */
    public function getIndexProdutoInativo() {
        
        // Seleciono todos os produtos inativos = 0
        $obj_produtos = Produto::select('id', 'nome', 'marca', 'preco', 'quantidade', 'created_at', 'updated_at')
                                    ->where('status', '=', 0)
                                    ->orderBy('id', 'DESC')
                                    ->get();
        
        if(empty($obj_produtos) ? count($obj_produtos) : 0){
            
            //Não encontrou produto inativo exibição da view
            return view('produto-vazio-inativo');
            
        }else{
            
            //encontrou produto inativo exibição da view
            return view('index-produto-inativo')->with('produtos', $obj_produtos);
            
        }
                   
    } 
    
    
    /**
     *
     * Método: Abre página de reativação de um produto específico do banco de dados.
     * ROUTE: /reativar-produto/{id}
     * Requisição: GET
     * @param int $id - Código do produto criptografado
     * @return \Illuminate\View\View  
     *
     * */
     public function getReativarProduto($id) {

        //decriptando o código que veio na URL
        $codigo_produto = Crypt::decrypt($id);
        
        //instanciando o objeto        
        $obj_produtos = Produto::where('id', '=', $codigo_produto)->where('status', '=', 0)->first(); 
                
        if(empty($obj_produtos)){
            
            //Nenhum produto encontrado Exibição da View info
            return view('produto-nao-encontrado');
            
        }else{
            
            //Produto encontrado exibição da view
            return view('reativar-produto')->with('produto', $obj_produtos)
                                            ->with('codigo_produto', $id);
            
        }

    }
    
    
    /**
     *
     * Método: Processamento do formulário de inativação de um produto específico do banco de dados.
     * ROUTE: /inativar-produto/
     * Requisição: POST
     * @return true ou false com msg de retorno
     *
     * */
    public function postReativarProduto(Request $request){ 
                
        // Recebendo o cod_produto e decriptando ..
        $codigo_produto = Crypt::decrypt($request->input('cod_produto'));
                
        // Recebendo informações do form
        $motivo = $request->input('motivo');

        //instancio o objeto para atualização
        $obj_produtos = Produto::where('id', '=', $codigo_produto)->where('status', '=', 0)->first();

        if(empty($obj_produtos)){
            
            //Não encontrou produto ativo
            return redirect()->back()->with('error', "Não foi possível inativar este produto. Tente novamente mais tarde!")->withInput($request->all());
            
        }else{
                        
            //Produto ativo encontrado
            
            //pego o status antigo
            $status_old = $obj_produtos->status;

            //Mascarando o status ANTIGO para guardar em log de [x] para [y]
            if ($status_old == 0){
                //status recebe
                $status_antigo = "inativo";

            } elseif ($status_old == 1) {
                //status recebe
                $status_antigo = "ativo";
            }

            // inativo o produto na TABELA PRODUTO
            $obj_produtos->status = 1;
            $obj_produtos->updated_at = date('Y-m-d H:i:s');

            //salvando o status
            $processa = $obj_produtos->save();

            //verificando se houve erro na inserção
            if (!$processa){
                //retorno da mensagem
                return redirect()->back()->with('error', "Não foi possível inativar este produto. Tente novamente mais tarde!")->withInput($request->all());

            }else{

                /************************************************************  
                  LOGS MONTANDO ESTRUTURA PADRÃO
                  INSERÇÃO DE LOGS (TUDO QUE O USUÁRIO FAZ NO SISTEMA)
                 * ******************************************************* */

                // Mascarando status ATUAL para guardar em log de: [X] para: [Y]
                if ($obj_produtos->status == 1){
                    $status_atual = "ativo";
                }elseif ($obj_produtos->status == 0) {
                    $status_atual = "inativo";
                }
                // Definindo o fuso horário por segurança
                date_default_timezone_set('America/Sao_Paulo');
                // Pego o IP
                $ip = $_SERVER['REMOTE_ADDR'];
                // Defino mensagem
                $mensagem = 'Inativação do produto ' . mb_strtoupper($obj_produtos->nome) . ' . O status desta foi modificado de ' . mb_strtoupper($status_antigo) . ' para ' . mb_strtoupper($status_atual) . ' . A Ação foi efetuada com o endereço de IP ' . $ip;

                $obj_log = new Log();
                $obj_log->mensagem = $mensagem;
                $obj_log->motivo = $motivo;
                $obj_log->created_at = date('Y-m-d H:i:s');
                $processa_log = $obj_log->save();

                //destruindo variáveis
                unset($obj_produtos);
                unset($processa);
                unset($obj_log);
                unset($processa_log);
                unset($mensagem);
                unset($motivo);
                unset($ip);
                unset($status_antigo);
                unset($status_atual);
                unset($codigo_produto);

                // Retorno para a index convenios
                return redirect('painel')->with('success', "O produto foi reativado com sucesso!");
            
            }
        }
    }    
    
    
}
