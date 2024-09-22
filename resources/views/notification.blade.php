@if(session("mensaje") && session("tipo"))
<div class="notification is-{{session('tipo')}} alert alert-success bg-success bg-gradient alert-dismissible fade show"
    role="alert">
    {{session('mensaje')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif