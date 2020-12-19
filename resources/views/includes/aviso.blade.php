
@if(session()->has('message'))
    <div class="alert alert-primary">
        <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Atenção: </strong>{{ session()->get('message') }}
    </div>
@endif
