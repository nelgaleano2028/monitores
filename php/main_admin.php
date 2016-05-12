<?php
session_start();
if (isset($_SESSION['nom'])){
		@$_SESSION['pas'];
        @$_SESSION['nom'];
}else{
header ("Location:cerrar.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:Monitor Web:.</title>
<style type="text/css">
@import url("../css/plantilla_user.css");


body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
a:link {
	text-decoration: none;
	color: #FFF;
}
a:linkba {
	text-decoration: none;
	color: #333
}
a:visited {
	text-decoration: none;
	color: #FFF;
}
a:hover {
	text-decoration: none;
	color: #FFF;
}
a:active {
	text-decoration: none;
	color: #FFF;
}
a {
	font-weight: bold;
}
</style>

<link rel="stylesheet" href="../css/google-buttons.css" type="text/css"  media="screen" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 <script src="../js/bootstrap-dropdown.js"></script>
    


</head>
<body class="barramenu">
  <table width="100%" border="0" height="auto">
    <tr>
      <td height="auto" valign="top"><table width="100%" border="0" height="auto">
        <tr>
          <td width="100%" height="35" colspan="4" class="monitores"><strong><?PHP echo @$_SESSION['nom'];?>||</strong> <a href="nuevopass_admin.php" target="mainFrame" class="linkba" style="
    color: black;">Modificar contraseña </a>||</strong> <a href="cerrar.php" class="linkba" style="
    color: black;">Cerrar sesion</a></td>
        </tr>
        <tr>
          <td width="280" height="48" class="certificados"><a href="inicio2.php" target="mainFrame">Consultar certificados de ingresos</a></td>
          <td width="280" height="48" class="comprobantes"><a href="admin_pagos.php" target="mainFrame">Consultar comprobantes de Pago</a></td>
          
          <td width="200" height="48" class="editar">
				<div class="g-button-group">
  					<a class="g-button dropdown-toggle" data-toggle="dropdown" href="#">Editar perfil empleados <span class="caret"></span></a>
  						<ul class="dropdown-menu">	
		   					<li><a href="editar_familiares.php" target="mainFrame"><i class="icon-user icon-black"></i> Familiar</a></li>
		     <li><a href="editar_educacion_formal.php" target="mainFrame"><i class="icon-book"></i>Educacion Formal</a></li>
		     <li><a href="editar_educacion_noformal.php" target="mainFrame"><i class="icon-pencil"></i>Educacion No Formal</a></li>
		     <li class="divider"></li>
		     <li><a href="jefe_hoja_vida.php" target="mainFrame"><i class="icon-file"></i>Hoja de vida</a></li>
							
 						 </ul>	
				</div>
            </td>

             <td width="280" height="48" class="comprobantes"><a href="admin_certificados.php" target="mainFrame">Certificados Laborales</a></td>
        </tr>
        <tr>
          <td height="550" colspan="4"><iframe src="inicio2.php" name="mainFrame" width="100%" height="775px" align="top" scrolling="Yes" frameborder="0" id="mainFrame"></iframe></td>
        </tr>
        <tr>
          <td height="auto" colspan="4" class="piepag">© 2012 Talentos y Tecnolog&iacute;a. Todos los derechos reservados - <a href="http://www.talentsw.com" style="color: #333">www.talentsw.com</a> - <a href="http://www.talentsw.com/desarrolladores/" style="color: #333">Desarrolladores</a> - <a href="http://www.talentsw.com/redentes/Index.php" style="color: #333">Soporte</a></td>
        </tr>
      </table></td>
    </tr>
  </table>
</body>
</html>
