@if(session("mensajex") && session("tipox"))
<div class="notification is-{{session('tipox')}} alert alert-warning bg-warning bg-gradient alert-dismissible fade show"
    role="alert">
    {{session('mensajex')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif