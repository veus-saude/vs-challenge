<label for="name">Nome completo:</label>
<input type="text" value="{{old('nome')}}" class="InputHome text-center text-sm-left" style="width:100%;{{$errors->has('nome')?'color:black;background-color:pink;':''}}" onkeyup="this.value = this.value.toLocaleUpperCase('pt-BR')" id="nome" placeholder="Nome completo" name="nome" pattern="^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9-_ .&'´`]{1,80}$" title="Favor preencher corretamente o campo nome" aria-label="Seu nome completo" required>
@if ($errors->has('nome'))
  <br />
  <span style="color:#FFD800;">
      {{$errors->first('nome')}}
  </span>
@endif
