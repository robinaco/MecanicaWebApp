<!-- need to remove -->
<li class="nav-item dropdown">
   <a href="{{ route('home') }}" class="nav-link">
      <i class="nav-icon fas fa-home"></i>
      <p>HOME</p>
   </a>
</li>
<hr class="dropdown-divider" style="color: orangered">
<li class="nav-item dropdown">
   <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
       aria-expanded="false">
       <i class="nav-icon fas fa-desktop"></i>
       <p>ADMINISTRACION</p>
   </a>
   <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
   <li><a class="dropdown-item bg bg-secondary" href="{{ route('ToolList') }}">Administrar Herramientas</a></li>
   <li><a class="dropdown-item bg bg-warning" href="{{ route('ProductList') }}">Gestionar Inventario</a></li>
       <li><a class="dropdown-item bg bg-secondary" href="{{ route('MechanicList') }}">Listar Técnicos</a></li>
       <li><a class="dropdown-item bg bg-warning" href="{{ route('getliquidations') }}">Listar Liquidaciones</a></li>
       <li><a class="dropdown-item bg bg-secondary" href="{{ route('buscarTecnico') }}">Buscar por Técnico</a></li>
       <li><a class="dropdown-item bg bg-warning" href="{{ route('searchSales') }}">Listar Ingresos Taller</a></li>
   </ul>
   
</li>
<hr class="dropdown-divider" style="color: orangered">
<li class="nav-item dropdown">
   <a href="{{ route('CustomerList') }}" class="nav-link">
      <i class="nav-icon fas fa-users"></i> 
      <p>CLIENTES</p>
   </a>
</li>
<hr class="dropdown-divider" style="color: orangered">
<li class="nav-item dropdown">
   <a href="{{ route('VehiculesList') }}" class="nav-link">
      <i class="nav-icon fas fa-car"></i> 
      <p>VEHICULOS</p>
   </a>
</li>
<hr class="dropdown-divider" style="color: orangered">
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="nav-icon fas fa-file-contract"></i>
        <p>ORDENES</p>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item bg bg-warning" href="{{ route('OrdenesLatonerias') }}">Listar Vigentes</a></li>
        <li><a class="dropdown-item bg bg-secondary" href="{{ route('OrdenesLatoneriasHistoricas') }}">Listar Historicas</a></li>
    </ul>
    
</li>

<hr class="dropdown-divider" style="color: orangered">
