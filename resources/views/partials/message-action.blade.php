@if (session('message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('message') }}
        <button class="btn-close" data-bs-dismiss="alert" aria-label="close" type="button"></button>
    </div>
@endif
