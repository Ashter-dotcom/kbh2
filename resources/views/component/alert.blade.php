@if(session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('warning'))
    <div class="alert alert-warning" role="alert">
        {{ session()->get('warning') }}
    </div>
@elseif(session()->has('info'))
    <div class="alert alert-info" role="alert">
        {{ session()->get('info') }}
    </div>
@elseif(session()->has('danger'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('danger') }}
    </div>
@endif