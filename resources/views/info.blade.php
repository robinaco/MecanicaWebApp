@if(session("mensajei") && session("tipoi"))
<div class="notification is-{{session('tipoi')}} alert alert-warning bg-warning bg-gradient alert-dismissible fade show"
    role="alert">
    {{session('mensajei')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif