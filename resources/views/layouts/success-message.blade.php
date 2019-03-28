@if (Session::has('success'))
<div class="alert alert-success alert-dismissible mt-3 show" style="z-index: 100;" role="alert">
    <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
    <span class="alert-inner--text"><strong>Success!</strong> {{ Session::get('success') }}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
