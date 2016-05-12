<?php
session_start();

include_once("class_empleado.php");

$empleado = new empleado();

$empleado->set_codigo(@$_SESSION["cod"]);//set de codigo del empleado se lo paso a la clase

/*Objetos que me capturan los datos a insertar o modificar*/


$dir=$_POST["direccion"];
$tel=$_POST["telefono"];
$barrio=$_POST["barrio"];
$cel=$_POST["celular"];
$dir2=$_POST["direccionalt"];
$tel2=$_POST["telefonoalt"];
$email=$_POST["email"];
$cod_civ=$_POST["estadocivil"];

$hijo=$_POST["numerohijos"];
$licen=$_POST["licencia"];
$cod_nie=$_POST["nivelest"];
$libreta=$_POST["libreta"];


if($hijo == ""){
    $hijo = "NULL";
}
   if($cod_nie == '-1'){
            $cod_nie = '';
        }
        if($cod_civ == '-1'){
            $cod_civ = "";
        }
        if($barrio == '-1'){
            $barrio = "";
        }
        if($cod_nie == '-1' || $cod_civ == '-1' || $barrio == '-1'){
            $barrio = "";
            $cod_civ = "";
             $cod_nie = "";
        }
/*--------------------------------------------------------*/

$validar=$empleado->validar_hoja_vida_tmp();//valido si ya se realizo una solicitud

if($validar > 0){//si existe una solicitud entonces modifique (actualizar)
    $respuesta=$empleado->editar_hoja_vida_temporal($dir,$tel,$dir2,$barrio,$tel2,$cel,$email,$cod_nie,$hijo,$cod_civ,$libreta,$licen);
    
}else{//inserte la nueva solicitud

$respuesta = $empleado->insert_hoja_vida($dir,$tel,$dir2,$barrio,$tel2,$cel,$email,$cod_nie,$hijo,$cod_civ,$libreta,$licen);
}
if($respuesta == true){
    $imprimir="La solicitud se ha enviado satisfactoriamente.";
    
    $email;
}else{
    $imprimir="Error al enviar la solicitud.";
    
}

echo $imprimir;




?>