<?php

include_once('lib/adodb/adodb.inc.php');
include_once('lib/configdb.php');

  
$query2 = "SELECT *
FROM T_NUEVO_PASS where USUARIO = 'aibarrera@imbanaco.com.co' ";
$rs2 = $conn->Execute($query2);
$row2 = $rs2->fetchrow();
       echo  $correopass2 = $row2['PASS'];
	   echo  $correopass1 = $row2['USUARIO'];
	   /*
	   $query2 = "select * from EMPLEADOS_GRAL WHERE COD_EPL = '29119412R1'";
$rs2 = $conn->Execute($query2);
$row2 = $rs2->fetchrow();
       echo  $correopass2 = $row2['EMAIL'];*/
	  
  ?>