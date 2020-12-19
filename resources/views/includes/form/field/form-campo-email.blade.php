<label for="email">E-mail:</label>
<input value="{{old('email')}}" type="email" class="InputHome text-center text-sm-left" style="width:100%; {{ $errors->has('email') ? 'color:black;background-color:pink;' : ''}}" onkeyup="this.value = this.value.toLocaleLowerCase('pt-BR')"  id="email" name="email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" aria-label="Seu e-mail" title="Este é o e-mail de preenchido na tela anterior" placeholder="exemplo@email.com" required>
@if ($errors->has('email'))
  <br><span style="color:#FFD800;">
      {{$errors->first('email')}}
  </span>
@endif
