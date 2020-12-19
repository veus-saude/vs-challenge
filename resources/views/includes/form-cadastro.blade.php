<form action="{{route('cadastrar')}}" method="POST" id="cadastrar">
    <div class="row" style="padding-top: 15px;">
      <div class="col-12 col-sm-6 espver3 text-center text-sm-left">
        @include('includes.form.field.form-campo-name')
      </div>
      <div class="col-12 col-sm-6 espver3 text-center text-sm-left">
        @include('includes.form.field.form-campo-email')
      </div>
      <div class="col-12 col-sm-6 espver3 text-center text-sm-left">
        @include('includes.form.field.form-campo-senha')
      </div>
    </div>
</form>
