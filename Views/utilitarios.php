<?php
include '../Controllers/CerrarSesionController.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function MostrarNombreUsuario()
{
    if ($_SESSION["Correo"] != null) {
        echo $_SESSION["Correo"] . ' / ' . $_SESSION["NombreRol"];
    } else {
        header("location: login.php");
    }
}

function BloquearPantallasAdministrador(){
    if ($_SESSION["NombreRol"] == "Administrador" || $_SESSION["NombreRol"] == "Cajero") {
        header("location: login.php");
    }
}
function BloquearPantallasCajero(){
    if ($_SESSION["NombreRol"] == "Cajero") {
        header("location: login.php");
    }
}
function BloquearPantallasBodeguero(){
    if ($_SESSION["NombreRol"] == "Bodeguero") {
        header("location: login.php");
    }
}

function mostrarMenu()
{
    echo '
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Supermercado la Amistad</div>
    </a>
    <hr class="sidebar-divider my-0">';
    if ($_SESSION["NombreRol"] == "Administrador" || $_SESSION["NombreRol"] == "Vendedor") {
        echo '
    <li class="nav-item active">
        <a class="nav-link" href="ventas.php?nombreProducto=">
            <i class="fas fa-store"></i>
            <span>Ventas</span></a>
    </li>';
    }
    echo '
    <hr class="sidebar-divider">
    ';
    if ($_SESSION["NombreRol"] == "Administrador" || $_SESSION["NombreRol"] == "Vendedor") {
        echo '<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Clientes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">               
                    <a class="collapse-item" href="clientesInsertar.php">Crear Usuario</a> 
                    <a class="collapse-item" href="clientesInformacion.php">informacion</a>
         </div>
        </div>
    </li>';
    }
    if ($_SESSION["NombreRol"] == "Administrador" || $_SESSION["NombreRol"] == "Bodeguero") {
    echo '
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProveedores"
            aria-expanded="true" aria-controls="collapseProveedores">
            <i class="fas fa-truck"></i>
            <span>Proveedores</span>
        </a>
         <div id="collapseProveedores" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="proveedorInsertar.php">Crear Proveedor</a>
                <a class="collapse-item" href="proveedorInformacion.php">Informacion</a>
            </div>
        </div> 
    </li>';
    }
    echo'
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventario"
            aria-expanded="true" aria-controls="collapseInventario">
            <i class="fas fa-warehouse"></i>
            <span>Productos</span>
        </a>
         <div id="collapseInventario" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">';
            if ($_SESSION["NombreRol"] == "Administrador" || $_SESSION["NombreRol"] == "Bodeguero") {
            echo '<a class="collapse-item" href="productoInsertar.php">Crear Producto</a>';
            }
            echo '
            <a class="collapse-item" href="productoInformacion.php">Informacion</a>
            </div>
        </div> 
    </li>';
    if ($_SESSION["NombreRol"] == "Administrador") {
    echo'<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras"
            aria-expanded="true" aria-controls="collapseCompras">
            <i class="fa fa-user"></i>
            <span>Empleados</span>
        </a>
         <div id="collapseCompras" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="empleadoInsertar.php">Crear Empleado</a>
            <a class="collapse-item" href="empleadoInformacion.php">Informacion</a>
            <a class="collapse-item" href="empleadoRecuperarCuenta.php">Recuperar Cuenta</a>
            </div>
        </div> 
    </li>';
    }
    if ($_SESSION["NombreRol"] == "Administrador") {
    echo'
    <li class="nav-item">
        
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes"
            aria-expanded="true" aria-controls="collapseReportes">
            <i class="fas fa-print"></i>
            <span>Reportes</span>
            </a> 
            <div id="collapseReportes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="facturas.php">Ver Historial Facturas</a>
                  </div>
              </div> 
          </li>';
    }
    echo'
    <li class="nav-item">
    <form action="" method="post" class="user">
            <a class="nav-link "
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas  fa-door-open wrap-2"></i>
                <span></span>
                <button  type="submit" name="btnSalir" id="brnSalir" class=" border-0 bg-transparent 
                text-white font-monospace " value="" ><span>Salir</span>       
                </button>
                <button  type="submit" name="btnSalir" id="brnSalir" class=" border-0 bg-transparent 
                text-primary font-monospace w-50" value="" >  .       
                </button>
            </a>
            </form>
            </li>
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    </ul>
    ';
}

function mostrarFooter()
{
    echo '
    <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2023</span>
        </div>
    </div>
    </footer>
    ';
}
