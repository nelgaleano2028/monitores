<?php
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');


global $conn;

//$sql="create table t_nuevo_pass(pass varchar(200), usuario varchar(200))";


//$sql="delete t_nuevo_pass where usuario='mayer'";

//$rs=$conn->Execute($sql);


$sql1="insert into t_nuevo_pass (PASS,USUARIO) values ('cambiar1234','baguilera.asistente@imbanaco.com.co')";


$rs1=$conn->Execute($sql1);

// while($fila=$rs1->fetchrow()){

// echo $fila["cod_epl"]." ";
// echo $fila["email"]." ";
// //echo $fila["USUARIO"]."<br>";
// }



?>