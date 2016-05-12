	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
	<link rel="stylesheet" href="../css/jquery.ui.all.css">
	<script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	
	<script src="../js/jquery.ui.button.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />
	<link rel="stylesheet" href="../css/demos.css">
	<link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
        <link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
        <link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
<!--boton-->
	<script>
	$(function() {
		$( "input:submit, a, button", ".demo" ).button();
		$( "a", ".demo" ).click(function() { return false; });
	});
	</script> 
 <!--hoja de vida-->
    <script type="text/javascript">  
    $(document).ready(function(){ 
            $.ajax({  
                url: 'hojadevida.php',  
                success: function(data) {  
                    $('#div_dinamico').html(data);  
                }  
            });  
        });  
    </script> 
    
<!--inicio familiares-->
<script type="text/javascript">  
    $(document).ready(function(){ 
            $.ajax({  
                url: 'nuevofamiliar.php',  
                success: function(data) {  
                    $('#div_dinamico_dos').html(data);  
                }  
            });  
        });  
    </script> 
    
    <!--editar familiares-->
<script type="text/javascript">  
    $(document).ready(function(){ 
	 $('#Editar_fam').click(function() {  
            $.ajax({  
                url: 'datosfamiliares.php',  
                success: function(data) {  
                    $('#div_dinamico_dos').html(data);  
                }  
            });  
        });  
    });  
    </script> 
    
<!--nuevo familiares-->
<script type="text/javascript">  
    $(document).ready(function(){
        $('#Nuevo_fam').click(function() {  
            $.ajax({  
                url: 'nuevofamiliar.php',  
                success: function(data) {  
                    $('#div_dinamico_dos').html(data);  
                }  
            });  
        });  
    });  
    </script> 
    
<!--inicio formal-->
<script type="text/javascript">  
    $(document).ready(function(){
            $.ajax({  
                url: 'educacionformalnuevo.php',  
                success: function(data) {  
                    $('#div_dinamico_tres').html(data);  
                }  
            });  
        });  
    </script> 
    
<!--nuevo formal-->
<script type="text/javascript">  
    $(document).ready(function(){
		        $('#Nuevo_for').click(function() {  
            $.ajax({  
                url: 'educacionformalnuevo.php',  
                success: function(data) {  
                    $('#div_dinamico_tres').html(data);  
                }  
            });  
        });  
		});
    </script>     
    
<!--actualizar formal-->
<script type="text/javascript">  
    $(document).ready(function(){
		        $('#Editar_for').click(function() {  
            $.ajax({  
                url: 'educacionformalactualizada.php',  
                success: function(data) {  
                    $('#div_dinamico_tres').html(data);  
                }  
            });  
        }); 
		}); 
    </script>     
    
<!--inicio no formal-->
<script type="text/javascript">  
    $(document).ready(function(){
            $.ajax({  
                url: 'educacionnoformalnuevo.php',  
                success: function(data) {  
                    $('#div_dinamico_cuatro').html(data);  
                }  
            });  
        }); 
    </script> 
    
<!--nuevo no formal-->
<script type="text/javascript">  
    $(document).ready(function(){
		$('#Nuevo_nofor').click(function() {  
            $.ajax({  
                url: 'educacionnoformalnuevo.php',  
                success: function(data) {  
                    $('#div_dinamico_cuatro').html(data);  
                }  
            });  
        });  
		 }); 
    </script> 
    
<!--actualizar no formal-->
<script type="text/javascript">  
    $(document).ready(function(){
				$('#Editar_nofor').click(function() {  
            $.ajax({  
                url: 'educacionnoformalactualizar.php',  
                success: function(data) {  
                    $('#div_dinamico_cuatro').html(data);  
                }  
            });  
        });  
		}); 
    </script> 
    
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
body,td,th {
	font-size: 14px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
.letra {
	font-size: 14px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	color: #FFF
}
</style>
<body bgcolor="#EEEEEE"><table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="80%" border="0" align="center" bgcolor="#FFFFFF">
      <tr>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td bgcolor="#0066CC"><p class="letra">Datos de Hoja de vida:</p></td>
        </tr>
      <tr>
        <td><div name="div_dinamico" id="div_dinamico" class="div_dinamico"></div></td>
      </tr>
      <tr>
        <td align="center"><img src="../imagenes/hr.png" width="258" height="16" /></td>
      </tr>
      <tr>
        <td bgcolor="#0066CC"><p class="letra">Datos de Familiares:</p></td>
      </tr>
      <tr>
        <td><div class="demo"><input name="Nuevo_fam" type="submit" id="Nuevo_fam" value="Nuevo"/><input name="Editar_fam" type="submit" id="Editar_fam" value="Editar"/></div></td>
      </tr>
      <tr>
        <td><div name="div_dinamico_dos" id="div_dinamico_dos" class="div_dinamico_dos"></div></td>
      </tr>
      <tr>
        <td align="center"><img src="../imagenes/hr.png" width="258" height="16" /></td>
      </tr>
      <tr>
        <td bgcolor="#0066CC"><p class="letra">Educacion Formal:</p></td>
      </tr>
      <tr>
        <td><div class="demo"><input name="Nuevo_for" type="submit" id="Nuevo_for" value="Nuevo"/><input name="Editar_for" type="submit" id="Editar_for" value="Editar"/></div></td>
      </tr>
      <tr>
        <td><div name="div_dinamico_tres" id="div_dinamico_tres" class="div_dinamico_tres"></div></td>
      </tr>
      <tr>
        <td align="center"><img src="../imagenes/hr.png" width="258" height="16" /></td>
      </tr>
      <tr>
        <td bgcolor="#0066CC"><p class="letra">Educacion No Formal:</p></td>
      </tr>
      <tr>
        <td><div class="demo"><input name="Nuevo_nofor" type="submit" id="Nuevo_nofor" value="Nuevo"/><input name="Editar_nofor" type="submit" id="Editar_nofor" value="Editar"/></div></td>
      </tr>
      <tr>
        <td><div name="div_dinamico_cuatro" id="div_dinamico_cuatro" class="div_dinamico_cuatro"></div></td>
      </tr>
      <tr>
        <td align="center"><img src="../imagenes/hr.png" width="258" height="16" /></td>
      </tr>
    </table></td>
  </tr>
  </table>
