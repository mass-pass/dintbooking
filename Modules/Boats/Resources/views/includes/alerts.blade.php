<!-- check for flash message -->
@if(!empty(session('message')))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">
            <i class="fa fa-times"></i>
        </span>
    </button>
    {{ session('message') }}
</div>
@endif
@if(!empty(session('exception')))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">
            <i class="fa fa-times"></i>
        </span>
    </button>
    {{ session('exception') }}
</div>
@endif