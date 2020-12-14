
@extends('layouts.base')

@section('conteudo')
    <div class="container" style="position: relative; top:30%;">
        <div class="row">
            <div class="col-md-5 col-xs-12 col-sm-12 mx-auto">
                <div class="card">
                    <h5 class="card-header">Login</h5>
                    <div class="card-body">
                        <form id="formLogin">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" required>
                            </div>
                            <button type="submit" id="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#formLogin').submit(function(e) {
                e.preventDefault();
                $('#login').prop('disabled',true).html('Carregando ...');
                axios.post('/api/auth/login', {
                    email: $('#email').val(),
                    password: $('#password').val(),
                })
                .then(function (response) {
                    if(response.data.token) {
                        localStorage.setItem('token', response.data.token);
                        window.location.href = "/admin/listagem";
                    }else{
                        
                    }
                })
                .catch(function (error) {
                    if(error.response.status == 401){
                        alert('Email ou senha incorreto');
                    }
                    if(error.response.status == 500){
                        alert('Erro tente novamente mais tarde');
                    }                        
                    $('#login').prop('disabled', false).html('Login');
                })                  
            });
        });
    </script>
@endsection
