<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "empleados";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM usuarios WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["consultarUsuario"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM usuarios WHERE usuario=".$_GET["consultarUsuario"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["consultarClientePorUsuario"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT u.id,u.nombre,u.correo,u.celular,u.cargo,u.usuario,c.nombre as nombreCliente FROM usuarios u INNER JOIN clientes c ON u.id_cliente=c.id");
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM usuarios WHERE id=".$_GET["borrar"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $correo=$data->correo;
    $celular=$data->celular;
    $cargo=$data->cargo;
    $usuario=$data->usuario;
    $contrasenia=$data->contrasenia;
    $id_cliente=$data->id_cliente;
        if(($correo!="")&&($nombre!="")&&($celular!="")&&($cargo!="")&&($usuario!="")&&($contrasenia!="")&&($id_cliente!="")){
            
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO usuarios(nombre,correo,celular,cargo,usuario,contrasenia,id_cliente) VALUES('$nombre','$correo','$celular','$cargo','$usuario','$contrasenia','$id_cliente') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $correo=$data->correo;
    $celular=$data->celular;
    $cargo=$data->cargo;
    $usuario=$data->usuario;
    $contrasenia=$data->contrasenia;
    $id_cliente=$data->id_cliente;
    
    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE usuarios SET nombre='$nombre',correo='$correo',celular='$celular',cargo='$cargo',usuario='$usuario',contrasenia='$contrasenia',id_cliente='$id_cliente' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla usuarios
if (isset($_GET["listarEmpleados"])){
$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM usuarios ");
if(mysqli_num_rows($sqlEmpleaados) > 0){
    $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
    echo json_encode($empleaados);
}
else{ echo json_encode([["success"=>0]]); }
}

// consultas de clientes
if (isset($_GET["listarClientes"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM clientes ");
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
    }
    else{ echo json_encode([["success"=>0]]); }
}

if (isset($_GET["consultarCliente"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM clientes WHERE id=".$_GET["consultarCliente"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if (isset($_GET["borrarCliente"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM clientes WHERE id=".$_GET["borrarCliente"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}

if(isset($_GET["insertarCliente"])){
    $data = json_decode(file_get_contents("php://input"));
    $nombre=$data->nombre;
    $nit=$data->nit;
    $direccion=$data->direccion;
    $celular=$data->celular;
    $tipoEmpresa=$data->tipoEmpresa;
        if(($nombre!="")&&($nit!="")&&($direccion!="")&&($celular!="")&&($tipoEmpresa!="")){
            
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO clientes (nombre,nit,direccion,celular,tipoEmpresa) VALUES('$nombre','$nit','$direccion','$celular','$tipoEmpresa') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}

if(isset($_GET["actualizarCliente"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizarCliente"];
    $nombre=$data->nombre;
    $nit=$data->nit;
    $direccion=$data->direccion;
    $celular=$data->celular;
    $tipoEmpresa=$data->tipoEmpresa;
    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE clientes SET nombre='$nombre',nit='$nit',direccion='$direccion',celular='$celular',tipoEmpresa='$tipoEmpresa' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}

?>
