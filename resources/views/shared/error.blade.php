<!-- error message -->
@if ($errors->any())
    <div class="content content-full">
        <div class="alert alert-danger alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h3 class="alert-heading font-size-h4 my-2">Error</h3>
            @foreach ($errors->all() as $error)
                <p class="mb-0">{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif
<!-- end error message -->
