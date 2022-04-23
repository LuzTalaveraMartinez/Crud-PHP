<?php 

function mostrarError($errores, $campo){
    $alerta ='';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
}
return $alerta;
}



function borrarErrores(){

    $borrado= false;

    if(isset($_SESSION['errores'])){
        $_SESSION['errores'] = null;
        $borrado= true;
    }

    if(isset($_SESSION['errores_entrada'])){
        $_SESSION['errores_entrada'] = null;
        $borrado= true;
    }


    if(isset($_SESSION['errores_categoria'])){
        $_SESSION['errores_categoria'] = null;
        $borrado= true;
    }


    if(isset($_SESSION['completado'])){
        $_SESSION['completado'] = null;
        $borrado= true;
    }

    return $borrado;
}




function conseguirCategorias($conexion){

    $sql= "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias= mysqli_query($conexion, $sql);

    $resultado= array();

    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado=$categorias;
    }

    return $resultado;
}



function conseguirCategoria($conexion, $id){

    $sql= "SELECT * FROM categorias WHERE id = $id;";
    $categorias= mysqli_query($conexion, $sql);

    $resultado= array();

    if($categorias && mysqli_num_rows($categorias) >= 1){
        $resultado=mysqli_fetch_assoc($categorias);
    }

    return $resultado;
}


function conseguirEntrada($conexion, $id){

    $sql= "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre , ' ', u.apellidos) AS usuario"
          ."  FROM entradas e ".
          "INNER JOIN categorias c ON e.categoria_id = c.id ".
          "INNER JOIN usuarios u ON e.usuario_id = u.id ".
          "WHERE e.id = $id";

    $entrada=mysqli_query($conexion, $sql);

    $resultado = array();

    if($entrada && mysqli_num_rows($entrada) >= 1){
        $resultado=  mysqli_fetch_assoc($entrada);
    }

    return $resultado;

}




function conseguirUltimasEntradas($conexion){

    $sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e " ."INNER JOIN categorias c ON e.categoria_id = c.id " ."ORDER BY e.id DESC LIMIT 4 ";

    $entradas= mysqli_query($conexion, $sql);

    $resultado= array();

    if($entradas && mysqli_num_rows($entradas) >=1){
        $resultado=$entradas;
    }

    return $entradas;
}




function conseguirEntradas($conexion, $limit=null, $categoria=null, $busqueda=null){

    $sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e " ."INNER JOIN categorias c ON e.categoria_id = c.id ";


    // Comprobamos si la variable $categoria viene vacia o tiene un valor que no sea string

    if(!empty($categoria)){
        $sql .="WHERE e.categoria_id = $categoria ";
    }

        // Comprobamos si la variable $busqueda viene vacia o tiene un valor que no sea string

    if(!empty($busqueda)){
        $sql .="WHERE e.titulo LIKE '%$busqueda%' ";
    }

        // Le añadimos un ORDER BY y le digo que me los ordene DESC

    $sql .=" ORDER BY e.id DESC ";

        // Comprobamos si la variable $limit viene vacia o tiene un valor que no sea string

    if($limit){
        // Equivalente a Sql = $sql."LIMIT 4"; a la sentencia de sql le concatenamos el LIMIT         
        $sql .= "LIMIT 4"; 
    }


    $entradas= mysqli_query($conexion, $sql);

    $resultado= array();

    if($entradas && mysqli_num_rows($entradas) >=1){
        $resultado=$entradas;
    }

    return $entradas;
} 
