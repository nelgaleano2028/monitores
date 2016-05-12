<?php require_once('../lib/configdb.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador</title>

<!-- ARCHIVOS CSS -->
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />
<link rel="stylesheet" type="text/css" href="../css/estilomio.css" />
<link rel="stylesheet" type="text/css" href="../css/mainCSS.css" />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />
	

<style type="text/css">
    @import "../css/datatable/demo_table.css";
    @import "../css/datatable/demo_page.css";
</style>


<!-- ARCHIVOS JAVASCRIPT -->

<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>
<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
<script type='text/javascript' src='../js/funciones.js'></script>
<script>
		$(document).ready(function(){
			try{
			$(".boton").button(); //clase para los botones
			}catch(err){return;}
			});
			$(function(){
			try{
			$(".combo").chosen(); //clase para los combobox
			var zidx = 100;
			$('.chzn-container').each(function(){
			$(this).css('z-index', zidx);
			zidx-=1;
			});
			}catch(err){return;}

            
        });
        </script>
<script>
$(document).ready(function() {
	
		$('#tabla-candidato-pt').dataTable({
          "bJQueryUI": true,
          "oLanguage":{
                              "sProcessing":   "Procesando...",
    "sLengthMenu":   "Mostrar _MENU_ registros",
    "sZeroRecords":  "No se encontraron resultados",
    "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
    "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
    "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
    "sInfoPostFix":  "",
    "sSearch":       "Buscar:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Primero",
        "sPrevious": "Anterior",
        "sNext":     "Siguiente",
        "sLast":     "Último"
    }
                      }
     	});
});
</script>

<script>
		function validar(){
			indice = document.getElementById("anio").selectedIndex;
			if( indice == null || indice == 0 || indice =="2015") {
  				alert("Seleccione un año correcto");
  				return false;
			}
		}
</script>

<script type="text/javascript">
		$(document).ready(function() {
			
			$("#check").click(function(){
				var oTable = $('#tabla-candidato-pt').dataTable();
				var nFiltered = oTable.fnGetFilteredNodes();
						
				//alert(nFiltered.length +' nodes were returned' );
		      	if($("#check").is(":checked")){
					//$( "input:checkbox", nFiltered ).attr("disabled", true);
	       			$( "input:checkbox", nFiltered ).attr("checked", "checked");
        		}else{
        			$( "input:checkbox", nFiltered ).removeAttr("checked");
        		}
			});
		});
</script>

<script type="text/javascript">
  $(document).ready(function() {

           $("#anio").change(function(){
              	indice = document.getElementById("anio").selectedIndex;
				
			
				//alert(indice+"jjjj");

              
              	if( indice == 0 ) {

						$("#aparecer").slideUp('slow');
                	
                }else{
              			if(indice ==1 ) {
							
								$("#aparecer").slideUp('slow');
								
				        		$("#aparecer").slideDown('slow');
								
								
						}else if(indice ==2 ) {
									
									    $("#aparecer").slideUp('slow');

				        				$("#aparecer").slideDown('slow');
										
										
					   			}else
								
								if(indice ==3 ) {
									
									    $("#aparecer").slideUp('slow');

				        				$("#aparecer").slideDown('slow');
										
										
					   			}
								else
								
								if(indice ==4 ) {
									
									    $("#aparecer").slideUp('slow');

				        				$("#aparecer").slideDown('slow');
										
										
					   			}
								
								// else
								
								// if(indice ==5 ) {
									
									    // $("#aparecer").slideUp('slow');

				        				// $("#aparecer").slideDown('slow');
										
										
					   			// }
								
								else{
						   
						   			alert("No hay datos");

									$("#aparecer").slideUp('slow');
								}
						
                }
            });
  }); 
</script>


<script type="text/javascript">

$(document).ready(function() {


	$('#dialog1').dialog({
						resizable: false,
						autoOpen: false,
						modal: true,
						width: 300,
						buttons: {
								"Aceptar": function() {
														var oTable= $('#tabla-candidato-pt').dataTable();
		                    							var sData = $('input:checked', oTable.fnGetNodes()).serialize();
														var envio=$("#envios").val();	
														var anio=$("#anio").val();	
														
														

			                		$.ajax({
		    	                    		type:"POST",
		    	                    		url: "pdfadm2.php",
		    	                    		data:sData+"&envio="+envio+"&anio="+anio,
							beforeSend: function(){
		      						notify("Enviando, favor esperar....",500,10800000,"info","info");
							
							},
		    	                    		success: function(datos){
				
					               			//$("#res").html(datos);
						           			notify(datos,500,10800000,"email","email");
						           			}
		                        		});
								
														$(this).dialog("close");	
									},
								"Cancelar": function() {
														$(this).dialog("close");
									}
								}
				});
				
				$('#dialog2').dialog({
						resizable: false,
						autoOpen: false,
						modal: true,
						width: 300,
						height:150,
						buttons: {
								"Aceptar": function() {
													$(this).dialog("close");	
									}
								}
				});
				
				
 	    $("#sefue").click(function(){
		
				var oTable = $('#tabla-candidato-pt').dataTable();
				var nFiltered = oTable.fnGetFilteredNodes();
			
			if($("input:checkbox", nFiltered).is(":checked")){
			 	
			 	$('#dialog1').dialog('open');
				
			}else{
			 	$('#dialog2').dialog('open');
				
			}
  });
  
});


</script>
       
        
</head>

<body>



<div id="principal">
	<form name="formulario"  id="formulario" method="post">
		<div id="titulo"><!--div titulo  -->  
			<h2>Envio de Certificados de Ingresos y Retenciones </h2>

    		<span style="font-weight:bold; font-family:Arial; font-size:13px">Año Certificado:</span>

    		<select name="anio" id="anio" class="combo" style="width:100px;">
      			<option value="">Seleccione</option>
      			<option value="2011">2011</option>
			    <option value="2012">2012</option>
			    <option value="2013">2013</option>
			    <option value="2014">2014</option>
			    <option value="2015">2015</option>
			
			
				
				
				
    		</select>
  
 		</div><!--cierre div titulo  -->
  		
        <br>
  		<br>
  
  
  
  		<div id="aparecer"><!--div aparecer  -->
  			<div id="centrado"><!--div centrado -->
  				<input type="hidden" value="envio" id="envios" />
  				<button type="button" value="Enviar" name="envio" id="sefue"  class="boton" style="width:100px">Enviar</button>
     		    <!--<div id="res"></div>-->
  			</div><!--cierre div centrado -->
  		
        	<br>
    
    		<div class="content-table"><!--div tabla -->
      			<table id="tabla-candidato-pt"  class="display">
        			<thead>
          				<tr>
            				<th>Cedula</th>
            				<th>Nombre</th>
            				<th>Apellido</th>
            				<th>Area</th>
            				<th>Cargo</th>
            				<th><center><input type="checkbox" name="check"  id="check" /></center></th>
          				</tr>
        			</thead>
                	<tbody>
          
		  <?php
             // $sql="select *, convert(varchar(20),fec_ret,111) as EndTime  from empleados_basic";
			 $sql="select *, convert(varchar(20),fec_ret,111) as EndTime  from empleados_basic emp, cargos car, centrocosto2 cen where emp.cod_car=car.cod_car and emp.cod_cc2=cen.cod_cc2 and emp.estado = 'A'";
	         //$sql="select *, convert(varchar(20),fec_ret,111) as EndTime from empleados_gral g, empleados_basic b where g.cod_epl=b.cod_epl";
	   
	         $rh = $conn->Execute($sql); 
	   			
	         while($row = $rh->FetchRow()){
	   				
				   //if($row["EndTime"]>='2011/01/01' || $row["EndTime"]=='' ){
					
	   		       if($row["EndTime"]=='' ){
       			
          ?>
        				<tr class="gradeX">
          					<td><?php echo $row['cedula'] ?></td>
          					<td><?php echo $row['nom_epl'] ?></td>
          					<td><?php echo $row['ape_epl'] ?></td>
          					<td><?php echo $row['nom_cc2'] ?></td>
          					<td><?php echo $row['nom_car'] ?></td>
                    		<td><center><input type="checkbox" name="vec[]" id="che" value='<?php echo $row['cedula'] ?>'/></center></td>
        				</tr>
          	<?php
		  		
			        }//Cierre if
			  }//Cierre While
			?>
        			</tbody>
    			</table>

 			</div><!--cierre div tabla  -->

		</div><!--cierre div aparecer  -->
	</form>
</div><!--cierre div principal-->


		<div id="dialog1" title="Aviso" style="display:none">
			<p style="font-weight:900">Esta seguro que desea enviar estos correos?</p>
		</div>
        <div id="dialog2" title="Aviso" style="display:none">
			<p style="font-weight:900">No hay datos a Enviar</p>
		</div>

</body>
</html>