<?php
session_start();
include_once("class_empleado.php");

$empleado = new empleado();

$lista3=$empleado->mostrar_no_formal_jefe(@$_SESSION['cod_admin']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
    
	<title>Vacaciones</title>
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
	<style type="text/css" title="currentStyle">
	    	        @import "../extras/TableTools/media/css/TableTools.css";
                        @import "../extras/TableTools/media/css/TableTools_JUI.css";
			@import "../media/css/demo_page.css";
			@import "../media/css/demo_table_jui.css";
			@import "../media/css/jquery-ui-1.8.4.custom.css";
			
		</style>			      
<!--<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />	-->		      
 <link type="text/css" href="../js/chosen/chosen.css" rel="stylesheet" />
 <link rel="stylesheet" href="../css/jquery.ui.all.css">			      
<link type="text/css" href="../css/paginacion.css" rel="stylesheet" />
<link type="text/css" href="../css/estilo.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/mainCSS.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/scroll.css"  />


<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type='text/javascript' src='../js/funciones.js'></script>



 <!-- PAGINACION-->
	<!-- <link rel="stylesheet" href="../js/__jquery.tablesorter/themes/blue/style.css" type="text/css"/>
	   <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.min.js" type="text/javascript"></script>
           <script src="../js/__jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>-->
          <!-- FIN PAGINACION-->
	  
	  
	  <script type="text/javascript" charset="utf-8" src="../media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.js"></script>
                <script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.min.js"></script>
 <script>
    
     
function modal_iframe(url,title,a,b,e){
        
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 20;
            var verticalPadding = 5;
            
            $('<iframe id="site" src="'+url+'" />').dialog({
            
                title: ($this.attr('title')) ? $this.attr('title') : '<H3>'+title+'</H3>',
                autoOpen: true,
                width: 800,
		dialogClass:'my-extra-class',
		
		position: "top",
                height: 380,
                modal: true,
		draggable: a, 
		resizable: b,
                autoResize: true,
		
		hide:'drop',
		overlay: { backgroundColor: "white", opacity: 0.5 },
		open: function (event,ui) {
		                           
		                           $(this).css('width','97%'),
		                           $(this).css('height','358px')
					   $('.ui-dialog-titlebar-close').css('visibility','hidden');
					   
					 
					   
					   },
	        buttons: {
                "Cerrar": function() {
                         $( this ).dialog( "close" );
			 
			 location.reload(true);
                                     }  
                        }
                })
	     } 


/*paginacion id de la tabla*/
            
                
		     $(document).ready(function() {
                
		
		$('#admin').dataTable( {
			    
			"bAutoWidth": false,
			"sScrollX": "100%",
		        "sScrollXInner": "148%",
		        "bScrollCollapse": true,
		        "aaSorting": [[ 5, "desc" ]],
			"bJQueryUI": true,
			"iDisplayLength": 5,
			
		        "oLanguage": {
				   
                                       "oPaginate": { 
                                                      "sPrevious": "Anterior", 
                                                      "sNext": "Siguiente", 
                                                      "sLast": "Ultima", 
                                                      "sFirst": "Primera" 
                                                    }, 
                                       "sLengthMenu": 'Mostrar <select>'+ 
                                       '<option value="5">5</option>'+ 
                                       '<option value="10">10</option>'+ 
                                       '<option value="25">25</option>'+ 
                                       '<option value="50">50</option>'+ 
                                       '<option value="100">100</option>'+ 
                                       '<option value="-1">Todos</option>'+ 
                                       '</select> registros', 
                                       "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 
                                       "sInfoFiltered": " - filtrados de _MAX_ registros", 
                                       "sInfoEmpty": "No hay resultados de busqueda", 
                                       "sZeroRecords": "No hay registros a mostrar", 
                                       "sProcessing": "Espere, por favor...", 
                                       "sSearch": "Buscar:", 
                                      }
		   });
         
			
            } );
			
          
     </script>
    </head>
 <body id="content">
 <br><br>

 <center>
			<h2>Solicitudes de Cambio de Datos de Educaci&oacute;n No Formal por Aprobar o Rechazar</h2>   

                    <table cellpadding="0" cellspacing="0" border="0" class="display " id="admin" width="100%">
						     
			      <thead>
			        <tr class="odd">
				<th width="9%" scope="col">Codigo</th>
				<th width="9%" scope="col">Cedula</th>
				<th width="9%" scope="col">Nombres y Apellidos </th>	
				<th width="9%" scope="col">Area</th>
				<th width="9%" scope="col">Cargo</th>
                                <th width="5%" scope="col">Ver Solicitud</th>
                                 
			        </tr>
			      </thead>
                    <tbody>
			      <?php
			   
			             for($i=0; $i<count($lista3); $i++){
						       
					
					
			      ?>
                              <td><?php echo $lista3[$i]['codigo']; ?></td>
			      <td><?php echo $lista3[$i]['cedula']; ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['nombre'])." ".utf8_decode($lista3[$i]['apellido']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['area']); ?></td>
			      <td><?php echo utf8_decode($lista3[$i]['cargo']); ?></td>
                              <td><a href="#" id="editar" onclick="modal_iframe('form_edu_no_formal.php?cod=<?php echo $lista3[$i]["codigo"];?>&prc=<?php echo $lista3[$i]["cod_prc"];?>&mdc=<?php echo $lista3[$i]["cod_mdc"];?>&area=<?php echo $lista3[$i]["cod_area"];?>&tca=<?php echo $lista3[$i]["cod_tca"];?>','Responder Solicitud de Datos de Educaci&oacute;n No Formal',false,false,event);">Ver</a></td>
			      
			       </tr>
			      <?php
			      
			          }
			       
			       ?>
                 </tbody>
                 </table>
		   

 </center>
</body>
</html>