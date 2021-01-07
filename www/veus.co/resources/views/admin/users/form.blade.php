<div class="row">

    <input type="text" name="name" placeholder="Name"   class="form-control mb-2" value="{{ old('name') ?? $user->name ?? '' }}"/>
    <input type="text" name="email" placeholder="E-mail"   class="form-control col-6 mb-2" value="{{ old('email') ?? $user->email ?? ""  }}"/>
    <input type="text" name="password" placeholder="Password"   class="form-control col-6 mb-2" value="{{ old('password') ?? $user->password ?? ""  }}"/>
    <input type="text" name="password_confirmation" placeholder="Password Confirmation"   class="form-control col-6 mb-2" value="{{ old('password_confirmation') ?? $user->password_confirmation ?? ""  }}"/>



    <select name="status" id="status" class="form-control mb-2">
        <option value="2" {{ (old() ? old('status', 2) : ($user->status ?? -2) == 2 ) ? 'selected' : '' }}>Admin</option>
        <option value="1" {{ (old() ? old('status', 1) : ($user->status ?? -1) == 1 ) ? 'selected' : '' }}>Usuário</option>
        <option value="0" {{ (old() ? old('status', 0) : ($user->status ?? -1) == 0 ) ? 'selected' : '' }}>Inativa</option>
    </select>

</div>
<div class="row">
<div class="col-6">

    <button type="submit" class="btn btn-primary" value="Enviar">Send</button>
</div>

<div class="col-6">
    <a class="btn btn-primary" href="{{ route('admin.products.index') }}" title="Go back">Cancel</a>
</div>
</div>
