<label for="name">Nome completo:</label>
<input type="text" value="{{old('name')}}" class="InputHome text-center text-sm-left" style="width:100%;{{$errors->has('name')?'color:black;background-color:pink;':''}}" onkeyup="this.value = this.value.toLocaleUpperCase('pt-BR')" id="name" placeholder="Nome completo" name="name" pattern="^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9-_ .&'´`]{1,80}$" title="Favor preencher corretamente o campo nome" aria-label="Seu nome completo" required>
@if ($errors->has('name'))
  <br />
  <span style="color:#FFD800;">
      {{$errors->first('name')}}
  </span>
@endif
