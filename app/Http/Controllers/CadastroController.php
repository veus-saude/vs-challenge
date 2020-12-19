<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use App\Produto;
use App\Estoque;
use App\Fornecedor;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CadastroValidator;
use App\Http\Requests\CadastroProdutoValidator;
use Illuminate\Support\Facades\DB;

class CadastroController extends Controller {

  /**
  *  formulario de contato.
  *
  * @return index
  */
  public function verificaemail(Request $r) {
    $email = $r->get('email');
    $usuario = User::where('email', $email)->count();
    if ($usuario > 0) {
      return redirect()->back()->with('#Mymodal.show');
    } else
    {
      return redirect('cadastro')
      ->with('email', $email);
    }
  }

  public function cadastro() {
    return view('cadastro');
  }

  public function cadastro_produto() {
    return view('cadastro_produto');
  }


  public function cadastro_estoque() {
    if (Auth()->user()->type[0]['type'] == 'admin') {
      $fornecedores = Fornecedor::all();
      $produtos = Produto::all();
      $estoque = Estoque::all();

    return view('cadastro_estoque')
    ->with('fornecedores', $fornecedores)
    ->with('produtos', $produtos)
    ->with('estoque', $estoque);
  } else {
    return view('home')
    ->withErrors('Você não tem permissão para realizar essa operação');
  }
  }

  public function cadastrar_estoque(Request $r) {
    if (Auth()->user()->type[0]['type'] == 'admin') {
      $token = $r->_token;

      if ($token) {

        $id_produto = $r->id_produto;
        $id_fornecedor = $r->id_fornecedor;
        $lote = $r->lote;
        $fabricacao = $r->fabricacao;
        $validade = $r->validade;
        $quantidade = $r->quantidade;
        $valor = str_replace(array('.',','),array('','.'),$r->valor);
        $estoque = new Estoque();
        $estoque->id_produto = $id_produto;
        $estoque->id_fornecedor = $id_fornecedor;
        $estoque->lote = $lote;
        $estoque->fabricacao = $fabricacao;
        $estoque->validade = $validade;
        $estoque->quantidade = $quantidade;
        $estoque->valor = $valor;
        $estoque->save();

        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        $estoque = Estoque::all();

      return view('cadastro_estoque')
      ->with('fornecedores', $fornecedores)
      ->with('produtos', $produtos)
      ->with('estoque', $estoque);

      } else {
        return view('home')
        ->withErrors('Você não tem permissão para realizar essa operação');
      }
    }
  }

  public function altera_produto(Request $r) {
    $token = $r->_token;

    if ($token) {

    $produto = Produto::where('id', $r->id)->first();
    return view('altera_produto')
    ->with('produto', $produto);
    } else {
     return view('home')
     ->withErrors('Erro de Autenticação');
    }

  }

  public function cadastrar(CadastroValidator $r) {

    $validator = Validator::make($r->all(), [
      'name' => 'required|max:80|regex:/[^*]/',
      'email' => 'required|regex:/[0-9a-z]*@[0-9a-z]*.[a-z]/|unique:users,email',
      'password' => 'required|min:8|max:15|regex:/[^*]/',
    ]);

    if ($validator->fails()) {

      return view('cadastro')
      ->withErrors($validator);

    } else {

      $token = $r->_token;

      if ($token) {
        $name = $r->name;
        $email = $r->email;
        $senha = $r->password;

        $user = new \App\User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($senha);
        $user->save();

        $client = User::where('email', $email)->first();

        $type_users = new \App\TypeUsers();
        $type_users->type_id = 2;
        $type_users->user_id = $client->id;
        $type_users->save();

        $data = array( 'name'=>$name,'email'=>$email,'senha'=>$senha );

        Mail::send(['html'=>'mail.email_cadastro'], $data, function($message) use ($name,$email,$senha) {
          $message->to($email, 'Receiver Name')
          ->subject('Bem-vindo à API Veus!');
          $message->from('desafio.desenvolvedor@gmail.com','API Veus');
        });
      } else {
        return view('cadastro')
        ->withErrors('Erro de Autenticação');
      }
    }
    return redirect('/');
  }

  public function cadastrar_produto(Request $r) {

    $validator = Validator::make($r->all(), [
      'nome' => 'required|max:80|regex:/[^*]/',
    ]);

    if ($validator->fails()) {

      return view('cadastro_produto')
      ->withErrors($validator);

    } else {

      $token = $r->_token;

      if ($token) {
        $nome = $r->nome;

        $produto = new \App\Produto();
        $produto->nome = ucwords($nome);
        $produto->save();

        return view('home')
        ->with('Produto cadastrado corretamente');

      } else {
        return view('cadastro_produto')
        ->withErrors('Erro de Autenticação');
      }
    }
    return redirect('/');
  }

  public function home() {
    $produtos = DB::table('estoque')
    ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
    ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
    ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')->paginate(15);
    // $produtos = (object) $produtos;
    //$produtos = $this->paginate($produtos);

    //$produtos = json_encode($produtos);

    //return response()->json([$produtos, 'success'=>true]);
    $filtered = false;

    return view('home')
    ->with('produtos', $produtos)
    ->with('filtered', $filtered);
  }

  static public function busca(Request $r) {
    $nome = null;
    $fornecedor = null;
    $lote = null;
    $fabricacao = null;
    $validade = null;
    $nome = $r->fnome;
    $fornecedor = $r->ffornecedor;
    $lote = $r->flote;
    $fabricacao = $r->ffabricacao;
    $validade = $r->fvalidade;

    if ($nome != null and $fornecedor == null and $lote == null and $fabricacao == null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('produtos.nome', 'like', $nome . '%')
      ->get()->toArray();
    }
    if ($nome != null and $fornecedor != null and $lote == null and $fabricacao == null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('produtos.nome', 'like', $nome . '%')
      ->where('fornecedor.nome', 'like', $fornecedor . '%')
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor != null and $lote == null and $fabricacao == null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('fornecedor.nome', 'like', $fornecedor . '%')
      ->get()->toArray();
    }
    if ($nome != null and $fornecedor != null and $lote != null and $fabricacao == null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('produtos.nome', 'like', $nome . '%')
      ->where('fornecedor.nome', 'like', $fornecedor . '%')
      ->where('estoque.lote', $lote)
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor != null and $lote != null and $fabricacao == null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('fornecedor.nome', 'like', $fornecedor . '%')
      ->where('estoque.lote', $lote)
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor == null and $lote != null and $fabricacao == null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('estoque.lote', $lote)
      ->get()->toArray();
    }
    if ($nome != null and $fornecedor != null and $lote != null and $fabricacao != null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('produtos.nome', 'like', $nome . '%')
      ->where('fornecedor.nome', 'like', $fornecedor . '%')
      ->where('estoque.lote', $lote)
      ->where('estoque.fabricacao', $fabricacao)
      ->get()->toArray();
    }
    if ($nome != null and $fornecedor != null and $lote != null and $fabricacao != null and $validade != null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('produtos.nome', 'like', $nome . '%')
      ->where('fornecedor.nome', 'like', $fornecedor . '%')
      ->where('estoque.lote', $lote)
      ->where('estoque.fabricacao', $fabricacao)
      ->where('estoque.validade', $validade)
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor == null and $lote == null and $fabricacao != null and $validade == null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('estoque.fabricacao', $fabricacao)
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor == null and $lote == null and $fabricacao == null and $validade != null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('estoque.validade', $validade)
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor == null and $lote == null and $fabricacao != null and $validade != null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('estoque.fabricacao', $fabricacao)
      ->where('estoque.validade', $validade)
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor == null and $lote != null and $fabricacao != null and $validade != null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('estoque.lote', $lote)
      ->where('estoque.fabricacao', $fabricacao)
      ->where('estoque.validade', $validade)
      ->get()->toArray();
    }
    if ($nome == null and $fornecedor != null and $lote != null and $fabricacao != null and $validade != null) {
      $produtos = DB::table('estoque')
      ->join('produtos', 'produtos.id', '=', 'estoque.id_produto')
      ->join('fornecedor', 'fornecedor.id', '=', 'estoque.id_fornecedor')
      ->select('produtos.id', 'produtos.nome', 'fornecedor.nome as fornecedor', 'estoque.lote', 'estoque.fabricacao', 'estoque.validade', 'estoque.quantidade', 'estoque.valor as valor')
      ->where('fornecedor.nome', 'like', $fornecedor . '%')
      ->where('estoque.lote', $lote)
      ->where('estoque.fabricacao', $fabricacao)
      ->where('estoque.validade', $validade)
      ->get()->toArray();
    }

    $produtos = json_encode($produtos);

    return view('home')
    ->with('jprodutos', $produtos);
  }

    public function alterar_produto(Request $r) {
      if (Auth()->user()->type[0]['type'] == 'admin') {

        $token = $r->_token;

        if ($token) {

          $produto = Produto::find($r->id);

          //validando se a empresa existe
          if ($produto === null) {
          return redirect('')->with('alert', 'Produto não encontrado!');;
          }

          $produto->update(['nome' => ucwords($r->nome)]);
          $produto->update();

          return redirect('/home')->with('alert', 'produto alterado !');

          } else {
          return view(welcome)
          ->withErrors('Operação não autorizada');
          }
        } else {
          return view(welcome)
          ->withErrors('Você não tem permissão para acessar essa página');
        }

    }


    public function excluir_produto(Request $r) {
      if (Auth()->user()->type[0]['type'] == 'admin') {

        $token = $r->_token;

        if ($token) {

          $produtos = Produto::where('id', $r->produto)->delete();

          return response()->json(['success'=>true],200);

          } else {
          return view(welcome)
          ->withErrors('Operação não autorizada');
          }
        } else {
          return view(welcome)
          ->withErrors('Você não tem permissão para acessar essa página');
        }

    }

}
