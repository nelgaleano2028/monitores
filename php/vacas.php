<?php
session_start();
require_once 'class_hojast.php';
?>

<?php

$lista10=array();


//80032398 comprobantes de pago
//66980923 Prestamos y Cuotas
//52822413 Cesantias
//66830581 Familiares
//338641 Todos menos Cesantias ni Familiares
$codigo=$_SESSION['cod'];

$obj=new class_hoja($codigo);


$lista10=$obj->vacaciones();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en">
    <head>
        <title>
            
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		
		 <script type="text/javascript" charset="utf-8" src="../media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.js"></script>
                <script type="text/javascript" charset="utf-8" src="../extras/TableTools/media/js/TableTools.min.js"></script>

   <!-- MODAL-->
   
   <script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
        <script src="../js/jquery.ui.core.js"></script>
	<script src="../js/jquery.ui.widget.js"></script>
	<script src="../js/jquery.ui.mouse.js"></script>
	<script src="../js/jquery.ui.button.js"></script>
	<script src="../js/jquery.ui.draggable.js"></script>
	<script src="../js/jquery.ui.position.js"></script>
	<script src="../js/jquery.ui.dialog.js"></script>
		
		<script type="text/javascript" charset="utf-8">
		    
		    
		    $(document).ready(function() {
    
 
			    
			    
			    
			    $(this).load('Sample.htm');
			$('#example1').dataTable( {                                		
            
	    
				"aaSorting": [[ 0, "desc" ]],
	    
	    
	    
	    
                                "bJQueryUI": true,
				"iDisplayLength": 5,
                                "sDom": '<"H"TfrlP>t<"F"ip><"clear">',
								"oTableTools": {
		                        				"sSwfPath": "../extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
												"aButtons": [
																{
																	"sExtends": "xls",
																	"sButtonText": "Guardar a Excel"
																},
																{
																	"sExtends": "pdf",
																	"sButtonText": "Guardar a PDF"
																},
 
															 ],
												},
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
					
} );
	
		$('#hola').click( function() {

		   $( "#demo1" ).dialog( "open" );
		   
	   } );
});
		    

		    
		</script>
    </head>
    	<body id="dt_example">
		
<script type="text/javascript">

(function(){
  var bsa = document.createElement('script');
     bsa.type = 'text/javascript';
     bsa.async = true;
     bsa.src = '//s3.buysellads.com/ac/bsa.js';
  (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
})();

 
</script>

<br>
		
			<div id="demo1">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example1">
<thead>
          				<tr class="odd">
					<th>Fecha Causaci&oacute;n Inicial</th>
					<th>Fecha Causaci&oacute;n Final</th>
					<th>D&iacute;as Tomados</th>
            				<th>Valor</th>
            				
            				
            			</tr>
        			</thead>
                	<tbody>
          
	 <?php
	    for($i=0; $i<count($lista10); $i++){
	 ?>
	 <tr>
	    <td><?php echo date("d-m-Y",strtotime($lista10[$i]['inicial']));  ?></td>
	    <td><?php echo date("d-m-Y",strtotime($lista10[$i]['final'])); ?></td>
	    <td><?php echo number_format($lista10[$i]['dias'],0, ",", "."); ?></td>
	    <td><?php echo number_format($lista10[$i]['valor'], 2, ",", "."); ?></td>
	    
		
		
	 </tr>	
	  <?php
	  }
	  ?>
    	 
          	
        		</tbody>
</table>
			</div>
			
	<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-365466-5");
pageTracker._trackPageview();
} catch(err) {}
</script></body>
</html>