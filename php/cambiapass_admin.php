<?php
session_start();
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');

$codigo = $_SESSION['nom'];;


@$passn = $_POST["passn"];
@$pass = $_POST["pass"];
@$actual = $_POST["passv"];

////var_dump($pass);die("");
//
//$query = "SELECT clv, cod_epl FROM EMPLEADOS_GRAL WHERE clv ='$actual'";
//$rs = $conn->Execute($query);
//$row = $rs->fetchrow();
//$password_actual = $row['clv'];
//$usuario_actual = $row['cod_epl'];


$query1 = "SELECT  nom_admin as NOM_ADMIN, contrasena as CONTRASENA FROM t_admin WHERE nom_admin ='$codigo'";
$rs1 = $conn->Execute($query1);
$row1 = $rs1->fetchrow();
$password_nuevo = $row1['CONTRASENA'];
$usuario_nuevo = $row1['NOM_ADMIN'];

if(empty($actual)){
header("Location:nuevopass_admin.php?456789=71");

}elseif (isset($password_nuevo) && $password_nuevo == $actual){

$query = "UPDATE t_admin SET contrasena='$pass' WHERE nom_admin='$codigo'";
$rs = $conn->Execute($query);

header("Location:nuevopass_admin.php?293875=76");

}else{
header("Location:nuevopass_admin.php?456789=71");

}



?>
