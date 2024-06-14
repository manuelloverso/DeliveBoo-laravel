@if (session('message'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('message') }}
        <button class="btn-close" data-bs-dismiss="alert" aria-label="close" type="button"></button>
    </div>
@endif
