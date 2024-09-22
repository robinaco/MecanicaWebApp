@if(session("mensajes") && session("tipos"))
<div class="notification is-{{session('tipos')}} alert alert-danger bg-danger bg-gradient alert-dismissible fade show" role="alert">
    {{session('mensajes')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif