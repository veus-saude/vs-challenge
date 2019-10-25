@extends('home\topo-home')

@section('content')
    
        <div class="row">
            <div class="col md-5">
                <h5>LOGIN</h5>
                
                <div class="col-sm-4">
                        <!--Alert sobre a sessão-->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('msg'))
                            <div class="alert alert-danger mt-3">
                                {{session('msg')}}
                            </div>
                        @endif
                    </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col md-5">
                
                <form action="{{route('autenticacao-login')}}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                            
                                <label class="form-group">E-mail</label>
                                <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Informe o email. Exemplo: email@veus.com" required>
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <label class="form-group">Senha</label>
                                <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control" placeholder="Informe a senha." required>
                            </div>

                            <button type="submit" class="btn btn-success btn-block btn-sm">Login</button>

                        </div>
                    </div>
                    
                </form>
                
            </div>
        </div>
    
@endsection
