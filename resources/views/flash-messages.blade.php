<div class="container mt-2 mb-4">
    @if ($message = session()->get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong><i class="fa fa-check-square-o"></i> {{ $message }}</strong>
    </div>
    @endif

    @if ($message = session()->get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong><i class="fa fa-times"></i> {{ $message }}</strong>
    </div>
    @endif

    @if ($message = session()->get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = session()->get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif
</div>