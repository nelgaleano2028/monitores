	<?php
	@session_start();
	require_once "functions.class.php";
	require_once("class_empleado.php");
	$ctl = new Catalogos();
	$empleado = new empleado();
	$empleado->set_codigo(@$_SESSION["cod"]);
	
	$lista=$empleado->mostrar_hoja_vida();
	
	?>
	<link rel="stylesheet" href="../css/jquery.ui.all.css">
	<link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
	<script src="../js/jquery-1.7.1.min.js"></script>
	<script type='text/javascript' src='../js/jquery-ui-1.8.17.custom.min.js'></script>
        <script type='text/javascript' src='../js/funciones.js'></script>
	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.button.js"></script>
	<link rel="stylesheet" href="../css/demos.css">
<!--boton-->
	<script>
		$(function() {
		
		llenar_combo("estadocivil","8","ajax_catalogos.php");
		llenar_combo("nivelest","7","ajax_catalogos.php");
		llenar_combo("barrio","11","ajax_catalogos.php");
		
		
		});
	$(function() {
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
	});
	
	  $(document).ready(function(){
		 $("#Enviar").click(function(event){
		 if($("#direccion").val() == "" ||
			   $("#telefono").val() == "" ||
			   $("#barrio").val() == "-1" ||
			   $("#celular").val() == "" ||
			   $("#email").val() == "" ||
			   $("#estadocivil").val() == "-1" ||
			   $("#nivelest").val() == "-1") {
				

                                $("#validacion9").css({'background' : '#FFEBE8', 'border' : '1px solid #DD3C10','line-height' : '15px','margin':'10px 0 0 0','text-align':'center','overflow':'hidden'});
				
				
				 $("#validacion9").html("<p>Debes completar los campos obligatorios ( <span style='font-size:16px'>*</span> )</p>");
			}else{
			 $.ajax({
				 type: 'POST', 
                                 url: "ajax_hoja_vida.php",
                                 data: $('#form1').serialize(),
				 success: function(data) {
					alert(data);
					$("#validacion9").removeAttr("style")
					$("#validacion9").html(" ");
					}
				});
			}
			})
	        })
	</script>

<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-size: 12px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.left {
	font-style: italic;
}
</style>
<form id="form1" name="form1" method="post" >
<div id="validacion9"></div>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="7">
      <tr>
        <td bgcolor="#EAEAEA">Dirección  
          <label for="direccion"></label>
          <input type="text" name="direccion" size="32" id="direccion" value="<?php echo $lista[0]["dir"]; ?>"/><span style="font-size: 18px;
color: rgb(221, 60, 16);"> *</span></td>
        <td bgcolor="#EAEAEA">Teléfono 
          <input type="text" name="telefono" id="telefono" onkeydown="return validarnum(event);" value="<?php echo $lista[0]["tel1"]; ?>"/> <span style="font-size: 18px;
color: rgb(221, 60, 16);">*</span></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Barrio
	<select name="barrio" id="barrio">
		
	</select> <span style="font-size: 18px;
color: rgb(221, 60, 16);"> *</span>
         </td>
        <td bgcolor="#EAEAEA">Celular
          <input type="text" name="celular" id="celular" onkeydown="return validarnum(event);" value="<?php echo $lista[0]["celular"]; ?>"/> <span style="font-size: 18px;
color: rgb(221, 60, 16);">*</span></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Dirección Alterna 
          <input type="text" name="direccionalt" id="direccionalt" value="<?php echo $lista[0]["dir2"]; ?>"/></td>
        <td bgcolor="#EAEAEA">Teléfono alterno 
          <input type="text" name="telefonoalt" id="telefonoalt" onkeydown="return validarnum(event);" value="<?php echo $lista[0]["tel2"]; ?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Email 
          <input type="text" name="email" id="email" value="<?php echo $lista[0]["email"];?>"/> <span style="font-size: 18px;
color: rgb(221, 60, 16);">*</span></td>
        <td bgcolor="#EAEAEA">Estado Civil
	<select  name="estadocivil" id="estadocivil" title="ATENCION: Es necesario presentar el soporte del Acta de Matrimonio a Gestion Humana"></select>  <span style="font-size: 18px;
color: rgb(221, 60, 16);">*</span>
         
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Numero de hijos 
          <input type="text" name="numerohijos" id="numerohijos" onkeydown="return validarnum(event);" value="<?php echo $lista[0]["num_hijo"];?>"/></td>
        <td bgcolor="#EAEAEA">Libreta Militar 
          <input type="text" name="libreta" id="libreta" value="<?php echo $lista[0]["libreta"];?>"/></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Licencia de Conducción 
          <input type="text" name="licencia" id="licencia" value="<?php echo $lista[0]["lic_con"];?>"/></td>
        <td bgcolor="#EAEAEA">Nivel de Estudio
	<select name="nivelest" id="nivelest" title="ATENCION: Es necesario presentar el respectivo soporte a Gestion Humana">
		
		
		
	</select>  <span style="font-size: 18px;
color: rgb(221, 60, 16);">*</span></td>
          
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#EAEAEA"><div class="demo"><input name="Enviar" type="button" class="boton" id="Enviar" value="Enviar"/></div></td>
        </tr>
      <tr>
        
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Actuales datos de Hoja de vida: <br /><br />
	Direccion: <?php echo $lista[0]["dir"]; ?><br />
	Barrio: <?php echo $lista[0]["barrio"]; ?><br />
	Direccion Alterna: <?php echo $lista[0]["dir2"]; ?><br />
	Email: <?php echo $lista[0]["email"]; ?><br />
	Numero de hijos: <?php echo $lista[0]["num_hijo"]; ?><br />
	Licencia de Conduccion: <?php echo $lista[0]["lic_con"]; ?><br />
	Telefono: <?php echo $lista[0]["tel1"]; ?><br />
	Celular: <?php echo $lista[0]["celular"]; ?><br />
	Telefono alterno: <?php echo $lista[0]["tel2"]; ?><br />
	Estado Civil: <?php echo $lista[0]["estado"]; ?><br />
	Libreta Militar: <?php echo $lista[0]["libreta"]; ?><br />
	Nivel de Estudio: <?php echo $lista[0]["nom_nie"]; ?></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
        </form>