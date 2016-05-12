<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>.:Monitor Web:.</title>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imagenes/loginSeleccion.jpg);
	background-color: #21343B;
	background-repeat: repeat-x;
}
#ingreso #ingreso {
	background-image: url(images/boton_entrar.png);
	height: 81px;
	width: 245px;
	background-repeat: no-repeat;
	background-position: center center;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-bottom: none;
	background-color: transparent;
}
.Estilo5 {
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo6 {
	color: #FFFFFF;
	font-size: 24px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo7 {
	color: #B5CCD5;
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
}
#ingreso #ingreso {
	background-image: url(imagenes/boton.png);
	height: 81px;
	width: 145px;
	background-repeat: no-repeat;
	background-position: center center;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	border-bottom: none;
	background-color: transparent;
}
body,td,th {
	font-family: "Trebuchet MS", Helvetica, Arial, Verdana, sans-serif;
}
a:link {
	color: #CCC;
}
a {
	font-size: 12px;
}
-->
</style>
    
<!--FUNCION DEL POP_UP-->
    <script>
	function abrir(url) {
	open(url,'','top=500,left=500,width=500,height=300') ;
	}
	</script> 
</head>
<body>
  <table width="1280" border="0">
    <tr>
      <td height="800" background="images/fondoLogueo2.jpg" valign="top">
      <table width="1280" border="0">
        <tr>
          <td height="110" colspan="4">
          
		  <form id="ingreso" name="ingreso" method="post" action="php/valida.php">
          <table width="1280" border="0" cellspacing="0" cellpadding="0">
                    <tr>
          <td width="150" height="110" rowspan="5">&nbsp;</td>
          <td width="200" height="110" rowspan="5">&nbsp;</td>
          <td rowspan="5">&nbsp;</td>
          <td height="10" colspan="3" class="Estilo5"><label class="Estilo5"></label></td>
          <td width="149" rowspan="5">&nbsp;</td>
        </tr>
        <tr>
          <td width="150" height="10" class="Estilo5">Correo Electronico</td>
          <td width="150"><span class="Estilo5">Contrase&ntilde;a</span></td>
          <td width="149" rowspan="3"><div align="center">
            <label>
            <input style="cursor: pointer;" name="ingreso" type="submit" class="#ingreso #ingreso" id="ingreso" value="      " />
            </label>
          </div></td>
        </tr>
        <tr>
          <td height="22"><input type="text" name="email" id="email" /></td>
          <td width="150"><input type="password" name="pass" id="pass" /></td>
          </tr>
        <tr>
          <td height="16" class="Estilo4"><a href="javascript:abrir('php/olvido_contrasena.php')">Olvide mi contrase&ntilde;a</a></td>
          <td width="150" rowspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td height="20">&nbsp;</td>
          <td width="149" height="17">&nbsp;</td>
        </tr>            
          </table>  
          </form>          
            <label class="Estilo5"></label></td>
          </tr>

        <tr>
          <td width="149" height="17">&nbsp;</td>
        </tr>
        <tr>
          <td height="690" colspan="4"><label></label></td>
          </tr>
      </table></td>
    </tr>
  </table>

<?php
if(empty($_GET['456778'])){
$_GET['456778'] = "";

}elseif($_GET['456778'] == "03"){ 
?> 
     <script> 
      alert("Los datos ingresados son incorrectos");
     </script>  
<?php
}

if(empty($_GET['33453'])){
$_GET['33453'] = "";

}elseif($_GET['33453'] == "06"){ 
?> 
     <script> 
      alert("Por favor escriba su correo electronico");
     </script>  
<?php
}
?>
</body>
</html>
