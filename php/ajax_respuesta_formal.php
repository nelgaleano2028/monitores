<?php
session_start();
require_once '../lib/connection.php';
include_once("class_empleado.php");
global $conn;
$empleado = new empleado();

$empleado->set_codigo(@$_POST["empleado"]);//set de codigo del empleado se lo paso a la clase

/*Objetos que me capturan los datos a insertar o modificar*/

if(@$_POST["fechaini"] == ""){
    $fechaini=null;
}else{
    $fechaini=date("d/m/Y", strtotime(@$_POST["fechaini"]));
	//$fechaini=$_POST["fechaini"];
}


if(@$_POST["fechafin"]== ""){
    $fechafin=null;
}else{
    $fechafin=date("d/m/Y", strtotime(@$_POST["fechafin"]));
	//$fechafin=$_POST["fechafin"];
}
$estudios=@$_POST["estudios"];
$profesion=@$_POST["profesion"];
$titulo=@$_POST["titulo"];
$radio=@@$_POST["radio"];
$ciudad=@$_POST["ciudad"];
$pais=@$_POST["pais"];
$entidad=@$_POST["entidad"];
$tiempouni=@$_POST["tiempouni"];
$tiempo=@$_POST["tiempo"];




/*--------------------------------------------------------*/

if($_POST["accion"]== "cancelar"){
    $respuesta=$empleado->eliminar_formal($titulo,$estudios,$_POST["empleado"]);
     $imprimir="Se cancelo la solicitud satisfactoriamente.";
}else{

$validar=$empleado->validar_formal($estudios,$titulo);//valido si ya se realizo una solicitud

if($validar > 0){//si existe una solicitud entonces modifique (actualizar)

    $respuesta=$empleado->editar_formal($estudios,$titulo,$fechaini,$fechafin,$tiempouni,$tiempo,$entidad,$ciudad,$pais);
    $empleado->eliminar_formal($titulo,$estudios,$_POST["empleado"]);
    $imprimir="Se realizaron cambios satisfactoriamente.";
}else{//inserte la nueva solicitud
$empl=$_POST["empleado"];
$sql="insert into cap_fictec
              values('$empl','F','$estudios ','$titulo',
              'si',NULL,NULL,NULL,NULL,
              (CONVERT(char(19), '$fechaini 00:00:00 a.m.',113)),
			  (CONVERT(char(19), '$fechafin 00:00:00 a.m.',113)),
             '$tiempo','$tiempouni',
             '$entidad','$ciudad','$pais',NULL)
             ";
//var_dump($sql);exit;
			 $rs=$conn->Execute($sql);
        if($rs== true){
			$empleado->eliminar_formal($titulo,$estudios,$empl);
            $imprimir="Se realizaron cambios satisfactoriamente.";
        }else{
            $imprimir="no se guardo los datos en  la base de datos.";
        }
			 
			 
//$respuesta = $empleado->insertar_formal($estudios,$titulo,$fechaini,$fechafin,$tiempouni,$tiempo,$tiempouni,$entidad,$ciudad,$pais);
/*$empleado->eliminar_formal($titulo,$estudios,$_POST["empleado"]);*/
$imprimir="Se realizaron cambios satisfactoriamente.";
}
}


echo $imprimir;




?>