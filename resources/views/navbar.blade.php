  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{route('admin_listagem')}}">Listagem <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('cadastro_produtos')}}">Cadastro de produtos</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-md-auto text-white">
        <li class="nav-item">
          <div id="user_login"></div>
        </li>
      </ul>
    </div>
  </nav>
  <script>
    $(document).ready(function () {
        instance.get(`/user`)
        .then(function (response) {
            if(!response.data.success){
                window.location.href = "/login";
            }
            $('#user_login').html(response.data.success.name)
        })
        .catch(function (error) {
            window.location.href = "/login";
        })
    });
  </script>