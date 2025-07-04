<?php


require_once('./librerias/Menu.php');
require_once('./librerias/Util.php');
require_once('./db/LoadDatos.php');


global $db; // Acceder a la instancia global de la base de datos
global $reservas; // <-- NUEVO
$reservas = [];   // <-- NUEVO

// --- Funciones para Parque Termal ---


function listarParquesTermales()
{
    global $db;
    mostrar("--- Listado de Parques Termales ---");
    $parques = $db->getParquesTermales();
    if (empty($parques)) {
        mostrar("No hay parques termales registrados.");
} else {
        foreach ($parques as $parque) {
echo $parque;
            echo ("\n");
        }
    }
    leer("\nPresione ENTER para continuar ...");
}


function agregarParqueTermal()
{
    global $db;
    mostrar("--- Agregar Parque Termal ---");


    $nombre = leer("Nombre: ");
    $ubicacion = leer("Ubicación: ");
    $localidad = leer("Localidad: ");
    $numero = leer("Número de teléfono: ");
    $mail = leer("Email: ");
    $capacidad = (int) leer("Capacidad máxima: ");


    $parque = new ParqueTermal($nombre, $ubicacion, $localidad, $numero, $mail, $capacidad);
    $db->agregarParqueTermal($parque);


    mostrar("Se agregó un nuevo parque termal.");
    leer("\nPresione ENTER para continuar ...");
}


function modificarParqueTermal()
{
    global $db;
    mostrar("--- Modificar Parque Termal ---");


    $nombreBusqueda = leer("Ingrese el nombre del parque termal a modificar: ");
    $parque = $db->buscarParqueTermalPorNombre($nombreBusqueda);


    if ($parque) {
        mostrar("Parque Termal encontrado: " . $parque);
        $parque->setNombre(leer("Nuevo Nombre ({$parque->getNombre()}): ", $parque->getNombre()));
        $parque->setUbicacion(leer("Nueva Ubicación ({$parque->getUbicacion()}): ", $parque->getUbicacion()));
        $parque->setLocalidad(leer("Nueva Localidad ({$parque->getLocalidad()}): ", $parque->getLocalidad()));
        $parque->setNumero(leer("Nuevo Número de teléfono ({$parque->getNumero()}): ", $parque->getNumero()));
        $parque->setMail(leer("Nuevo Email ({$parque->getMail()}): ", $parque->getMail()));
        $parque->setCapacidad((int) leer("Nueva Capacidad ({$parque->getCapacidad()}): ", (string)$parque->getCapacidad()));


        mostrar("Parque termal modificado exitosamente.");
    } else {
        mostrar("No se encontró el parque termal con el nombre: " . $nombreBusqueda);
    }
    leer("\nPresione ENTER para continuar ...");
}


function borrarParqueTermal()
{
    global $db;
    mostrar("--- Borrar Parque Termal ---");


    $nombre = leer("Ingrese el nombre del parque termal a borrar: ");
    $resultado = $db->borrarParqueTermalPorNombre($nombre);


    if ($resultado) {
        mostrar("Se borró el parque termal.");
    } else {
        mostrar("No se encontró el parque termal.");
    }
    leer("\nPresione ENTER para continuar ...");
}


function gestionarParquesTermales()
{
    $menu = Menu::getMenuParquesTermales();
    $opcion = $menu->elegir();
    while ($opcion->getNombre() != 'Volver') {
        $funcion = $opcion->getFuncion();
        call_user_func($funcion);
        $opcion = $menu->elegir();
    }
}


// --- Funciones para Usuarios ---


function listarUsuarios()
{
    global $db;
    mostrar("--- Listado de Usuarios ---");
    $usuarios = $db->getUsuarios();
    if (empty($usuarios)) {
        mostrar("No hay usuarios registrados.");
} else {
        foreach ($usuarios as $usuario) {
echo $usuario;
            echo ("\n");
        }
    }
    leer("\nPresione ENTER para continuar ...");
}


function agregarUsuario()
{
    global $db;
    mostrar("--- Agregar Usuario ---");


    $apellido = leer("Apellido: ");
    $nombre = leer("Nombre: ");
    $dni = leer("DNI: ");
    $edad = (int) leer("Edad: ");
    $nacimiento = leer("Fecha de Nacimiento (YYYY-MM-DD): ");
    $localidad = leer("Localidad: ");


    $usuario = new Usuario($apellido, $nombre, $dni, $edad, $nacimiento, $localidad);
    $db->agregarUsuario($usuario);


    mostrar("Se agregó un nuevo usuario.");
    leer("\nPresione ENTER para continuar ...");
}


function modificarUsuario()
{
    global $db;
    mostrar("--- Modificar Usuario ---");


    $dniBusqueda = leer("Ingrese el DNI del usuario a modificar: ");
    $usuario = $db->buscarUsuarioPorDNI($dniBusqueda);


    if ($usuario) {
        mostrar("Usuario encontrado: " . $usuario);
        $usuario->setApellido(leer("Nuevo Apellido ({$usuario->getApellido()}): ", $usuario->getApellido()));
        $usuario->setNombre(leer("Nuevo Nombre ({$usuario->getNombre()}): ", $usuario->getNombre()));
        $usuario->setEdad((int) leer("Nueva Edad ({$usuario->getEdad()}): ", (string)$usuario->getEdad()));
        $usuario->setNacimiento(leer("Nueva Fecha de Nacimiento ({$usuario->getNacimiento()}): ", $usuario->getNacimiento()));
        $usuario->setLocalidad(leer("Nueva Localidad ({$usuario->getLocalidad()}): ", $usuario->getLocalidad()));


        mostrar("Usuario modificado exitosamente.");
    } else {
        mostrar("No se encontró el usuario con el DNI: " . $dniBusqueda);
    }
    leer("\nPresione ENTER para continuar ...");
}


function borrarUsuario()
{
    global $db;
    mostrar("--- Borrar Usuario ---");


    $dni = leer("Ingrese el DNI del usuario a borrar: ");
    $resultado = $db->borrarUsuarioPorDNI($dni);


    if ($resultado) {
        mostrar("Se borró el usuario.");
    } else {
        mostrar("No se encontró el usuario.");
    }
    leer("\nPresione ENTER para continuar ...");
}


function gestionarUsuarios()
{
    $menu = Menu::getMenuUsuarios();
    $opcion = $menu->elegir();
    while ($opcion->getNombre() != 'Volver') {
        $funcion = $opcion->getFuncion();
        call_user_func($funcion);
        $opcion = $menu->elegir();
    }
}


// --- Funciones para Tipos de Entradas ---


function listarTiposEntradas()
{
    global $db;
    mostrar("--- Listado de Tipos de Entradas ---");
    $tiposEntradas = $db->getTiposEntradas();
    if (empty($tiposEntradas)) {
        mostrar("No hay tipos de entradas registrados.");
    } else {
        foreach ($tiposEntradas as $tipo) {
            echo $tipo;
            echo ("\n");
        }
    }
    leer("\nPresione ENTER para continuar ...");
}


function agregarTipoEntrada()
{
    global $db;
    mostrar("--- Agregar Tipo de Entrada ---");


    $nombre = leer("Nombre del tipo de entrada (ej. Menores de 2 años, CUD, etc.): ");
    $tipoEntrada = new TipoEntrada($nombre);
    $db->agregarTipoEntrada($tipoEntrada);


    mostrar("Se agregó un nuevo tipo de entrada.");
    leer("\nPresione ENTER para continuar ...");
}


function modificarTipoEntrada()
{
    global $db;
    mostrar("--- Modificar Tipo de Entrada ---");


    $nombreBusqueda = leer("Ingrese el nombre del tipo de entrada a modificar: ");
    $tipoEntrada = $db->buscarTipoEntradaPorNombre($nombreBusqueda);


    if ($tipoEntrada) {
        mostrar("Tipo de Entrada encontrado: " . $tipoEntrada);
        $tipoEntrada->setNombre(leer("Nuevo Nombre ({$tipoEntrada->getNombre()}): ", $tipoEntrada->getNombre()));
        mostrar("Tipo de entrada modificado exitosamente.");
    } else {
        mostrar("No se encontró el tipo de entrada con el nombre: " . $nombreBusqueda);
    }
    leer("\nPresione ENTER para continuar ...");
}


function borrarTipoEntrada()
{
    global $db;
    mostrar("--- Borrar Tipo de Entrada ---");


    $nombre = leer("Ingrese el nombre del tipo de entrada a borrar: ");
    $resultado = $db->borrarTipoEntradaPorNombre($nombre);


    if ($resultado) {
        mostrar("Se borró el tipo de entrada.");
    } else {
        mostrar("No se encontró el tipo de entrada.");
    }
    leer("\nPresione ENTER para continuar ...");
}


function gestionarTiposEntradas()
{
    $menu = Menu::getMenuTiposEntradas();
    $opcion = $menu->elegir();
    while ($opcion->getNombre() != 'Volver') {
        $funcion = $opcion->getFuncion();
        call_user_func($funcion);
        $opcion = $menu->elegir();
    }
}
function reservarEntrada()
{
    global $db, $reservas;

    mostrar("--- Reservar Entrada ---");

    // 1. Seleccionar usuario
    $usuarios = $db->getUsuarios();
    if (empty($usuarios)) {
        mostrar("No hay usuarios registrados.");
        leer("Presione ENTER para continuar ...");
        return;
    }
    mostrar("Seleccione el usuario:");
    foreach ($usuarios as $i => $usuario) {
        mostrar(($i + 1) . " - " . $usuario->getNombre() . " " . $usuario->getApellido() . " (DNI: " . $usuario->getDni() . ")");
    }
    $opUsuario = (int)leer("Ingrese el número de usuario: ") - 1;
    if (!isset($usuarios[$opUsuario])) {
        mostrar("Opción inválida.");
        return;
    }
    $usuarioSeleccionado = $usuarios[$opUsuario];

    // 2. Seleccionar tipo de entrada
    $tipos = $db->getTiposEntradas();
    if (empty($tipos)) {
        mostrar("No hay tipos de entradas registrados.");
        leer("Presione ENTER para continuar ...");
        return;
    }
    mostrar("Seleccione el tipo de entrada:");
    foreach ($tipos as $i => $tipo) {
        mostrar(($i + 1) . " - " . $tipo->getNombre());
    }
    $opTipo = (int)leer("Ingrese el número de tipo de entrada: ") - 1;
    if (!isset($tipos[$opTipo])) {
        mostrar("Opción inválida.");
        return;
    }
    $tipoSeleccionado = $tipos[$opTipo];

    // 3. Crear la reserva
    $reserva = new EntradaAdquirida($usuarioSeleccionado, $tipoSeleccionado);
    $reservas[] = $reserva;

    mostrar("¡Reserva realizada con éxito!");
    mostrar($reserva);
    leer("Presione ENTER para continuar ...");
}

// --- Menú Principal ---


mostrar("Sistema de Gestión de Parque Termal");
mostrar("===================================");
mostrar("(C) 2025");


$menu = Menu::getMenuPrincipal();
$opcion = $menu->elegir();


while ($opcion->getNombre() != 'Salir') {
    $funcion = $opcion->getFuncion();
    call_user_func($funcion);
    $opcion = $menu->elegir();
}


mostrar("¡Gracias por usar el sistema!");


?>