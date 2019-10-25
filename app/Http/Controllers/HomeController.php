<?php

namespace App\Http\Controllers;
use App\Produto;

use Illuminate\Http\Request;
use Auth;
use App;

class HomeController extends Controller
{
    public function getEncerrarSessao() {
        
        $sessaoEncerrada = Auth::logout();
        
        if(empty($sessaoEncerrada)){
            
            //Não existe sessão
            return view('home.index');
            
        }        
    }
    //
    public function getIndex()
    {
        //Retorno da view 
        return view("home.index");
    }
    
    //
    public function postLogin(Request $request) {
                        
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);
        
        $credenciais = ['email' => $request->email, 'password' => $request->password];
        
        if(Auth::attempt($credenciais)){
            
            // Autenticação concedida
            return redirect()->intended('painel');
            
        }else{
            
            return redirect()->back()->with('msg', 'Acesso negado para estas credenciais.');
            
        }
                
    }
    
    
    //Retorna view PAINEL com os dados da pesquisa
    public function getEscopoPesquisa(){
        
        //Filtrar a pesquisa de acordo com a informação que o usuário informar (o usuário vai informar os dados para busca)               
        $pesquisa = \Request::get('pesquisa');

        $obj_produtos = Produto::where('nome', 'like', '%' .$pesquisa. '%')
                                  ->orWhere('marca', 'like', '%' .$pesquisa. '%')
                                  ->orderBy('id')
                                  ->paginate(5);
                                    
        return view('auth.principal')->with('pesquisa', $pesquisa)
                                     ->with('produtos', $obj_produtos);
                    
    }
    
    
    //Retorna view Painel
    public function painel(){
                     
        // Seleciono todos os produtos inativos = 0
        $obj_produtos = Produto::select('id', 'nome', 'marca', 'preco', 'quantidade', 'created_at', 'updated_at')
                                    ->where('status', '=', 1)
                                    ->orderBy('id', 'DESC')                                    
                                    ->paginate(5);
        
        
        if(empty($obj_produtos)){
            
            //Não encontrou produto inativo exibição da view
            return view('produto-vazio');
            
        }else{
            
            //encontrou produto inativo exibição da view
            return view('auth.principal')->with('produtos', $obj_produtos);
            
        }
        
    }
    
    
}
