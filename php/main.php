<?php
session_start();
if (isset($_SESSION['ced'])){
		@$_SESSION['cod'];
		@$_SESSION['cor'];        
        @$_SESSION['nom'];
		@$_SESSION['ape'];
}else{
header ("Location:cerrar.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>.:Monitor Web:.</title>

<script src="../js/jquery-1.7.1.min.js"></script>
<!--[if lt IE 10]>
<script type="text/javascript" src="../PIE/PIE.js"></script>
<![endif]-->

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
<![endif]-->

<!--[if lt IE 8]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->




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
<script>


  
function adjustFrame(frame){  
var frmTemp;  
if (document.all) {  
var w = frame.document.body.scrollWidth;  
var h = frame.document.body.scrollHeight;  
  
if(frame.document.body.scrollWidth > frame.document.body.offsetWidth) {  
document.all[frame.name].height = h + 30 ;  
}  
else {  
document.all[frame.name].height = h;  
}  
}  
else if (document.getElementById) {  
  
var w = frame.document.width;  
var h = frame.document.height;  
  
if(frame.document.body.scrollWidth > frame.document.body.offsetWidth) {  
document.getElementById(frame.name).height = h;  
}  
else {  
document.getElementById(frame.name).height = h;  
}  
}  
return false;  
}  
</script>  
</head>
<body class="barramenu" onload=reSize()>
  <table width="100%" border="0" height="auto">
    <tr>
      <td height="auto" valign="top"><table width="100%" border="0" height="auto">
        <tr>
          <td width="100%" height="35" colspan="4" class="monitores"><strong><?PHP echo @$_SESSION['nom'];?> <?php echo @$_SESSION['ape'];?>||</strong> <a href="nuevopass.php" target="mainFrame" class="linkba" style="
    color: black;">Modificar contraseña </a>||</strong> <a href="cerrar.php" class="linkba" style="
    color: black;">Cerrar sesion</a></td>
        </tr>
        <tr>
          <td width="260" height="48" class="hv"><a href="inicio4.php" target="mainFrame">Hoja de Vida</a></td>
          <td width="260" height="48" class="comprobantes"><a href="pagos.php" target="mainFrame">Comprobantes de Pago</a></td>
          <td width="320" height="48" class="certificados"><a href="certificado.php" target="mainFrame">Certificados de Ingresos y Retenciones</a></td>
          <td width="260" height="48" class="per"><a href="modificardatos.php" target="mainFrame">Editar Perfil</a></td>
        </tr>
        <tr>
          <td height="550" colspan="4"> 
		  <iframe src="inicio4.php" name="mainFrame" width="100%" height="775px" align="top" scrolling="auto" frameborder="0" id="mainFrame" onload="adjustFrame('mainFrame')" ></iframe>
		  </td>
        </tr>
        <tr>
          <td height="auto" colspan="4" class="piepag">© <?php echo date("Y"); ?> Talentos y Tecnolog&iacute;a. Todos los derechos reservados - <a href="http://www.talentsw.com" style="color: #333">www.talentsw.com</a> - <a href="http://www.talentsw.com/desarrolladores/" style="color: #333">Desarrolladores</a> - <a href="http://www.talentsw.com/redentes/Index.php" style="color: #333">Soporte</a></td>
        </tr>
      </table></td>
    </tr>
  </table>
</body>
</html>
