<label for="senha">Escolha uma senha:</label>
<input type="password" class="InputHome text-center text-sm-left" style="width:100%;{{$errors->has('password')?'color:black;background-color:pink;':''}}" id="senha" placeholder="" minLength="8" name="password" title="Favor preencher corretamente o campo senha, com ao menos 8 caracteres." aria-label="Senha" required>
@if ($errors->has('password'))
  <br />
  <span style="color:#FFD800;">
      {{$errors->first('password')}}
  </span>
@endif
