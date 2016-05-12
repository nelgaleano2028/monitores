<?php
include_once('../lib/adodb/adodb.inc.php');
include_once('../lib/configdb.php');

$email = $_POST["email"];
$pass = utf8_encode($_POST["pass"]);




$query = "select a.cod_epl AS COD_EPL, a.nom_epl AS NOM_EPL, a.ape_epl AS APE_EPL, a.cedula AS CEDULA, b.email AS EMAIL from empleados_basic a, empleados_gral b where a.estado = 'A' and a.cod_epl = b.cod_epl and b.email = '$email'";



$rs = $conn->Execute($query);
$row3 = $rs->fetchrow();
        $contrasenapass = $row3['CEDULA'];
	$correopass = $row3['EMAIL'];
		
$query1 = "SELECT NOM_ADMIN AS NOM_ADMIN, CONTRASENA AS CONTRASENA FROM T_ADMIN WHERE NOM_ADMIN = '$email' ";
$rs1 = $conn->Execute($query1);
$row1 = $rs1->fetchrow();
       		$correopass1 = $row1['NOM_ADMIN'];
		    $contrasenapass1 = $row1['CONTRASENA'];
                


$query2 = "SELECT C.COD_EPL, C.NOM_EPL, C.APE_EPL, C.CEDULA, B.EMAIL, A.PASS, A.USUARIO
FROM EMPLEADOS_BASIC C, T_NUEVO_PASS A, EMPLEADOS_GRAL B 
WHERE C.COD_EPL = B.COD_EPL AND A.USUARIO = B.EMAIL AND A.USUARIO = '$email'";
$rs2 = $conn->Execute($query2);
$row2 = $rs2->fetchrow();
        $correopass2 = $row2['USUARIO'];
		$contrasenapass2 = $row2['PASS'];


//evita la seguridad del IE hasta cierto punto... si deshabilitan las cookies totalmente llorelo!

header('P3P: CP="IDC DSP COR CURa DMa OUR IND PHY ONL COM STA"');

if (empty($email)){
header("Location:../index.php?33453=06");
}
elseif ($correopass == $email && $contrasenapass == $pass && empty($contrasenapass2)) {
	session_start();
	$_SESSION['cod'] = $row3['COD_EPL'];
        $_SESSION['cor'] = $row3['EMAIL'];
        $_SESSION['ced'] = $row3['CEDULA'];
        $_SESSION['nom'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
header("Location:nuevopass.php?mensaje=1");
}
elseif ($correopass2 == $email && $contrasenapass2 == $pass ) {

		
		session_start();
	$_SESSION['cod'] = $row3['COD_EPL'];
        $_SESSION['cor'] = $row3['EMAIL'];
        $_SESSION['ced'] = $row3['CEDULA'];
        $_SESSION['nom'] = $row3['NOM_EPL'];
	$_SESSION['ape'] = $row3['APE_EPL'];
header("Location:main.php");
}
elseif ($correopass1 == $email && $contrasenapass1 == $pass) {
	session_start();
       $_SESSION['pas'] = $row1['CONTRASENA'];
       $_SESSION['nom'] = $row1['NOM_ADMIN'];
       
header("Location:main_admin.php");
}
else {
header("Location:../index.php?456778=03");
}
$conn->Close();
?>