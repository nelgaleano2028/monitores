<?php
@session_start();
require_once 'class_hojast.php';

//ano 

$year = date("Y");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<style>
 
html {
/*-ms-scrollbar-face-color: gray;
-ms-scrollbar-track-color: gray;*/
scrollbar-face-color:#e8e8e8; 

scrollbar-3dlight-color:white; 
scrollbar-darkshadow-color:white; 


scrollbar-track-color:#white; 
} 


::-webkit-scrollbar{ 
background:#fff; 
width:16px;
height: 16px;
overflow: visible;
} 
::-webkit-scrollbar-thumb { 
background-color: rgba(0, 0, 0, .2);
background-clip: padding-box;
border: solid transparent;
border-width: 1px 1px 1px 6px;
min-height: 28px;
padding: 100px 0 0;
box-shadow: inset 1px 1px 0 rgba(0, 0, 0, .1),inset 0 -1px 0 rgba(0, 0, 0, .07);
} 
::-webkit-scrollbar-thumb:hover { 
background-color:#a8a6a6; 
} 
::-webkit-scrollbar-button { 
height: 0; 
width: 0;

} 
::-webkit-scrollbar-track { 
background-clip: padding-box;
border: solid transparent;
border-width: 0 0 0 4px;
} 
::webkit-scrollbar-corner { 
background: transparent; 
} 



table#padre{ width:90%;}
table{ width:100%; }

   #testTable { 
           
            margin-left: auto;
            /**margin-left: 35%;*/
            margin-right: auto;
            
 
          }
          
          #tablePagination { 
            background-color: #DCDCDC; 
            
            padding: 0px 5px;
            padding-top: 2px;
            height: 25px
          }
          
          #tablePagination_paginater { 
            margin-left: auto; 
            margin-right: auto;
          }
          
          #tablePagination img { 
            padding: 0px 2px; 
          }
          
          #tablePagination_perPage { 
            float: left; 
          }
          
          #tablePagination_paginater { 
            float: right; 
          }
</style>


<link rel="stylesheet" type="text/css" href="../css/estilo.css" />
<link rel="stylesheet" type="text/css" href="../css/plantilla_user.css" />



<link type="text/css" href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/jquery-ui-1.8.17.custom.css" />
<link rel="stylesheet" type="text/css" href="../css/general.css" />
<link rel="stylesheet" type="text/css" href="../js/chosen/chosen.css"  />

 <link rel="stylesheet" href="../css/jquery.ui.all.css">
 

    
<style type="text/css">
    @import "../css/datatable/demo_table.css";
    @import "../css/datatable/demo_page.css";
</style>


<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
<script type='text/javascript' src="../js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" src='../js/dataTables.fnGetFilteredNodes.js'></script>

<script type='text/javascript' src='../js/funciones.js'></script>

   <!-- MODAL-->
   	<script type='text/javascript' src="js/jquery-ui-1.8.17.custom.min.js"></script>
   	<script type="text/javascript" src="../js/chosen/chosen.jquery.js"></script>
   	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.mouse.js"></script>
	<script src="js/jquery.ui.button.js"></script>
	<script src="js/jquery.ui.draggable.js"></script>
	<script src="js/jquery.ui.position.js"></script>
	<script src="js/jquery.ui.dialog.js"></script>
	
	 <!-- PAGINACION-->
	 <link rel="stylesheet" href="../js/__jquery.tablesorter/themes/blue/style.css" type="text/css"/>
	   <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablePagination.0.5.min.js" type="text/javascript"></script>
           <script src="../js/__jquery.tablesorter/jquery-latest.js" type="text/javascript"></script>
          <script src="../js/__jquery.tablesorter/jquery.tablesorter.js" type="text/javascript"></script>
          <!-- FIN PAGINACION-->
          
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hoja de Vida</title>

<script type="text/javascript" charset="utf-8">
		    
 $(document).ready(function() {
	    
	    
	   function modal_iframe(url,title,e){
        
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 20;
            var verticalPadding = 5;
            
            $('<iframe id="site" src="'+url+'" />').dialog({
            
                title: ($this.attr('title')) ? $this.attr('title') : '<H3>'+title+'</H3>',
                autoOpen: true,
                position: "top",
                draggable: false, 
                width: 800,
                height: 380,
                modal: true,
		resizable: false,
                autoResize: true,
		hide:'drop',
		open: function (event,ui) {
		                         
		                           $(this).css('width','97%'),
		                           $(this).css('height','358px')
					 
					   
					   },
		
	        buttons: {
		    
                "Cerrar": function() {
                         $( this ).dialog( "close" );
                                     }
				     
                     }
                
            })
	    
	    } 
   
	 $('#pagos').click( function(e) {
	
      	modal_iframe("forma.php","Forma de Pago",e);
		
	} );
	$('#liqs').click( function(e) {
	
      	modal_iframe("historia_liq.php","Historial Liquidacion",e);
		
	} );
	$('#cers').click( function(e) {
	
      	modal_iframe("configcertificado.php","Certificados",e);
		
	} );
	$('#aums').click( function(e) {
	
      	modal_iframe("aumento.php","Aumentos",e);
		
	} );
	$('#cess').click( function(e) {
	
      	modal_iframe("cesantias.php","Cesantias Pagadas",e);
		
	} );
	$('#fams').click( function(e) {
	
      	modal_iframe("familia.php","Familiares",e);
		
	} );
	$('#vacs').click( function(e) {
	
      	modal_iframe("vacas.php","Vacaciones",e);
		
	} );
	$('#enero').click( function(e) {
	
      	modal_iframe("enero.php","Enero",e);
		
	} );
	$('#febrero').click( function(e) {
	
      	modal_iframe("febrero.php","Febrero",e);
		
	} );
	$('#marzo').click( function(e) {
	
      	modal_iframe("marzo.php","Marzo",e);
		
	} );
	$('#abril').click( function(e) {
	
      	modal_iframe("abril.php","Abril",e);
		
	} );
	$('#mayo').click( function(e) {
	
      	modal_iframe("mayo.php","Mayo",e);
		
	} );
	$('#junio').click( function(e) {
	
      	modal_iframe("junio.php","Junio",e);
		
	} );
	$('#julio').click( function(e) {
	
      	modal_iframe("julio.php","Julio",e);
		
	} );
	$('#agosto').click( function(e) {
	
      	modal_iframe("agosto.php","Agosto",e);
		
	} );
	$('#septiembre').click( function(e) {
	
      	modal_iframe("septiembre.php","Septiembre",e);
		
	} );
	$('#octubre').click( function(e) {
	
      	modal_iframe("octubre.php","Octubre",e);
		
	} );
	$('#noviembre').click( function(e) {
	
      	modal_iframe("noviembre.php","Noviembre",e);
		
	} );
	$('#diciembre').click( function(e) {
	
      	modal_iframe("diciembre.php","Diciembre",e);
		
	} );
	 
});
		    
</script>



    <script>
	/*paginacion id de la tabla*/
            $(document).ready(function() {
            $('#prestamos').tablePagination({});
	    
	    $('#embargos').tablePagination({});
	    $('#traslados').tablePagination({});
	    $('#cargos').tablePagination({});
	    $('#contratos').tablePagination({});
			
			
            } );
			
            /*quita todo conflicto de jquery*/
              var $j = jQuery.noConflict();
			  
			  /*ordenamiento id de la tabla*/
         $j(document).ready(function(){
    
        $j("#prestamos").tablesorter();
	
	$j("#embargos").tablesorter();
	$j("#traslados").tablesorter();
	$j("#cargos").tablesorter();
	$j("#contratos").tablesorter(); 
    } 
); 
        </script>

</head>

<body>


<?php
$lista1=array();
$lista2=array();
$lista3=array();
$lista4=array();
$lista5=array();
$lista6=array();
$lista7=array();
$lista8=array();
$lista9=array();
$lista10=array();
$lista11=array();
$lista12=array();
$lista13=array();
$lista14=array();
$lista15=array();


$obj=new class_hoja(@$_SESSION['cod']);

$lista1=$obj->ultimos_comprobantes();
$lista2=$obj->prestamos();
$lista3=$obj->embargos();
$lista4=$obj->historia_liq();
$lista5=$obj->formas_pago();
$lista6=$obj->certificado();
$lista7=$obj->aumentos();
$lista8=$obj->cesantias();
$lista9=$obj->familiares();
$lista10=$obj->vacaciones();
$lista11=$obj->hist_centro_costo();
$lista12=$obj->historico_cargos();
$lista13=$obj->historico_contratos();
$lista14=$obj->hist_quin_nomina();
$lista15=$obj->ausencias_por_mes();

?>



<table id="padre" border="0" style="border:1px solid #9CA5A9;">
	<tr valign="top">
    	<td style="border-left:none; border-bottom:none">
        	<table id="infoGeneral" border="0" style="border:0px" >
            	<tr>
                	<td colspan="7" style="border:0px"><h2>INFORMACION GENERAL</h2></td>
                </tr>
                
                <tr>
				<td width="5%" style="border:0px" class="menuhv"><a id="fams">Familiares</a></td>
				<td width="5%" style="border:0px" class="menuhv"><a id="vacs">Vacaciones</a></td>
				<td width="5%" style="border:0px" class="menuhv"><a id="cers">Certificado Laboral</a></td>
				 </tr>
                <tr>
				<td width="5%" style="border:0px" class="menuhv"><a id="cess">Cesantias Pagadas</a></td>
				<td width="5%" style="border:0px" class="menuhv" ><a id="pagos" title="Formas de pago">Formas de Pago </a></td>
                </tr>
                <tr>
                	<td colspan="7" style="border:0px" > 
<table width="100%">
<caption style="font-weight:bold; text-align: left"><h3>ULTIMOS 5 COMPROBANTES DE PAGO</h3></caption>
  <thead>
	<tr class="odd">
		<th width="20%" scope="col">Numero</th>
	  	<th width="25%" scope="col">Liquidacion</th>
		<th width="12%" scope="col">Periodo</th>	
	  	<th width="25%" scope="col">Año</th>
	  	<th width="29%" scope="col">Fecha</th>
	</tr>	
	</thead>
	<tbody>
    <?php
     if($lista1==NULL){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     $i=0;
     while($i<count($lista1)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
	  
	  <form method="post" id="pago" name="pago" action="pdf.php"  target="TargetFrame">
    
    	<?php  $obj->set_num_comp($lista1[$i]["numero"]); ?>
               
               
             <!--Ini Para ver 5 reportes de compr-->
             <input type="hidden" id="ano" name="ano" value="<?php echo $obj->repor_ultimos_comprobantes("num"); ?>"/>
             <input type="hidden" id="ano" name="ano" value="<?php echo $obj->repor_ultimos_comprobantes("ano"); ?>"/>
             <input type="hidden" id="per" name="per" value="<?php echo $obj->repor_ultimos_comprobantes("periodo"); ?>"/>
             <input type="hidden" id="liqui" name="liqui"  value="<?php echo $obj->repor_ultimos_comprobantes("liqui"); ?>"/>
             <input type="hidden" id="tipo" name="tipo" value="<?php echo $obj->repor_ultimos_comprobantes("tipo"); ?>"/>
             <input type="hidden" id="ver" name="ver" value=""/>
             
         <?php require_once '../yelitza.php';

 if($bloquear==1){?> 
       
	<td><a href="#" onclick="javascript:document.forms[<?php echo $i; ?>].submit();"><?php echo $lista1[$i]["numero"]; ?></a></td>	
<?php }elseif($bloquear!=1){?>

	<td><a href="#"><?php echo $lista1[$i]["numero"]; ?></a></td>
<?php }?>	    
		
		<td><?php echo $lista1[$i]["liquidacion"]; ?></td>
		<td><?php  echo $lista1[$i]["periodo"];?></td>
		<td><?php  echo $lista1[$i]["ano"]; ?></td>
		<td><?php echo $lista1[$i]["fecha"]; ?></td>
        </form>
	</tr>	<?php $i++; }}?>
 	
	</tbody>
</table>
                   
                                      
                    </td>
                </tr>
                
                
                <tr>
                	<td colspan="7" >
                  
                    
                    
<table width="100%" id="traslados" class="tablesorter">
<caption style="font-weight:bold; text-align: left"><h3>TRASLADOS DE AREA</h3></caption>

  <thead>
	<tr class="odd">
		<th width="35%" scope="col">Fecha</th>
	  	<th width="35%" scope="col">Anterior</th>
		<th width="35%" scope="col">Actual</th>	
	  	<!--th width="33%" scope="col">Observacion</th>
	  	<th width="22%" scope="col">Usuario</th>-->
	</tr>	
	</thead>
  
	<tbody>
    <?php
        
     if($lista11==NULL){
		echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     $i=0;
     while($i<count($lista11)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
 	
		<td><?php echo date("d/m/Y",strtotime($lista11[$i]['fecha'])); ?></td>
		<td><?php echo $lista11[$i]["anterior"]; ?></td>
		<td style="text-align:center"><?php  echo $lista11[$i]["actual"];?></td>
		<!--<td style="text-align:center"><?php  echo $lista11[$i]["observacion"]; ?></td>
		<td><?php echo $lista11[$i]["usuario"]; ?></td>-->
	</tr>	<?php $i++; } }?>
 	
	</tbody>
</table>
                   
                    </td>
                </tr>
                
                <tr>
                	<td colspan="7" style="border:0px" ><!-- TABLA CARGOS -->
                    
               
<table width="100%" id="cargos" class="tablesorter">
<caption style="font-weight:bold; text-align: left"><h3>HISTORICO DE CARGOS</h3></caption>
  <thead>
	<tr class="odd">
		<th width="35%" scope="col">Fecha</th>
	  	<th width="35%" scope="col">Anterior</th>
		<th width="35%" scope="col">Actual</th>	
	  	<!--<th width="33%" scope="col" >Observacion</th>
	  	<th width="22%" scope="col">Usuario</th>-->
	</tr>	
	</thead>
  
	<tbody>
    <?php
    
     if($lista12==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
       
     $i=0;
     while($i<count($lista12)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
 	
		<td><?php echo date("d/m/Y",strtotime($lista12[$i]['fecha'])); ?></td>
		<td style="text-align:center"><?php echo $lista12[$i]["anterior"]; ?></td>
		<td style="text-align:center"><?php  echo $lista12[$i]["actual"];?></td>
		<!--<td style="text-align:center"><?php  echo $lista12[$i]["observacion"]; ?></td>
		<td><?php echo $lista12[$i]["usuario"]; ?></td>-->
	</tr>	<?php $i++; }}?>
 	
	</tbody>
</table>
                
                                      
                    </td>
                </tr>
                
                
                <tr>
                	<td colspan="7" style="border:0px" >  <!-- TABLA CONTRATOS -->
                    
                     
<table width="100%" id="contratos" class="tablesorter">
<caption style="font-weight:bold; text-align: left"><h3>HISTORICO DE CONTRATOS</h3></caption>
  <thead>
	<tr class="odd">
		<th width="35%" scope="col">Fecha</th>
	  	<th width="35%" scope="col">Anterior</th>
		<th width="35%" scope="col">Actual</th>	
	  	<!--<th width="33%" scope="col">Observacion</th>
	  	<th width="22%" scope="col">Usuario</th>-->
	</tr>	
	</thead>
  
	<tbody>
    <?php
    
     if($lista13==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     $i=0;
     while($i<count($lista13)){
     
     if($i % 2){
     
     echo "<tr class='odd'>";
     }else{
     echo "<tr>";
     }
      ?>
 	
		<td><?php echo date("d/m/Y",strtotime($lista13[$i]['fecha'])); ?></td>
		<td style="text-align:center"><?php echo $lista13[$i]["anterior"]; ?></td>
		<td style="text-align:center"><?php  echo $lista13[$i]["actual"];?></td>
		<!--<td style="text-align:center"><?php  echo $lista13[$i]["observacion"]; ?></td>
		<td><?php echo $lista13[$i]["usuario"]; ?></td>-->
	</tr>	<?php $i++; }}?>
 	
	</tbody>
	
</table>
                    
                    
        
                  </td>
                </tr>               
            </table>
        </td>
        
        <td style="border-left:1px solid #9CA5A9; border-bottom:none">
        	<table id="infoFinanciera" border="0" style="border:0px" >    
            	<tr>
                	<td style="border:0px" ><h2>INFORMACION FINANCIERA</h2></td>
                </tr>
                
                <tr>
                	<td style="border:0px" >
			<div id="testTable">
                        <table width="100%" id="prestamos" class="tablesorter">
                        <caption style="font-weight:bold; text-align: left"><h3>PRESTAMOS CON LA EMPRESA</h3></caption>
                          <thead>
                            <tr class="odd">
                                <th width="25%" scope="col">Numero</th>
                                <th width="25%" scope="col">Fecha</th>
                                <th width="20%" scope="col">Valor</th>	
                                <th width="25%" scope="col">Saldo</th>
                                <th width="30%" scope="col">Estado</th>
                            </tr>	
                           </thead>
                          
                            <tbody>
                        <?php
                            
                            $var="odd";
                            
                            if($lista2==NULL){
                        ?>
                            <tr>
                                <td colspan="5">No hay Datos a Mostrar</td>
                            </tr>
                        <?php	
                            }else{
                            
                             for($i=0; $i<count($lista2); $i++){
                             
                                if($i % 2){
                             
                                    echo "<tr class='odd'>";
                                }else{
                                    echo "<tr>";
                                }
                        ?>
                            
                                <td><?php echo $lista2[$i]['numero']  ?></td>
                                <td class="si"><?php echo date("d/m/Y",strtotime($lista2[$i]['fecha_rad']));  ?></td>
                                <td class="si"><?php echo number_format($lista2[$i]['valor'], 2, ",", ".")  ?></td>
                                <td class="si"><?php echo number_format($lista2[$i]['saldo'], 2, ",", ".")  ?></td>
				
				
                                <td class="si">
				    <?php
					    if($lista2[$i]['estado']=='C')
						echo"Cancelado";
					    else
						echo"Pendiente";
				
				
				
				
				    ?>
				</td>
                                
				
                            </tr>	
                            <?php 
                            }
                            
                            }
                            
                            ?>
                              
                            </tbody>
			    
                        </table>
			
			</div>	
            	<table><tr><td><span style="font-size: smaller">Nota:"En Caso de tener una Libranza debe comunicarse directamente con la entidad"</span></td></tr></table>	
                    </td>
                </tr>
				
                <tr>
                	<td style="border:0px" >
                    	<div id="embargos">
                        <table width="100%">
                          <caption style="font-weight:bold; text-align: left"><h3>EMBARGOS</h3></caption>
                          <thead>
                            <tr class="odd">
                                <th width="25%" scope="col">Numero</th>
                                <th width="25%" scope="col">Fecha Final</th>
                                <th width="30%" scope="col">Valor</th>	
                                <th width="30%" scope="col">Saldo</th>
                             </tr>	
                           </thead>
                          
                            <tbody>
                        <?php
                            $var="odd";
                            
                            if($lista3==NULL){
                        ?>
                                <tr>
                                    <td colspan="5">No hay Datos a Mostrar</td>
                                </tr>
                        <?php	
                            }else{	
                            
                                for($i=0; $i<count($lista3); $i++){
                             
                                    if($i % 2){
                             
                                            echo "<tr class='odd'>";
                                    }else{
                                            echo "<tr>";
                                    }
                        ?>
                            
                                <td ><?php echo $lista3[$i]['numero'] ?></td>
                                <td><?php  if($lista3[$i]['fecha_fin_emb'] != null){echo date("d/m/Y",strtotime($lista3[$i]['fecha_fin_emb']));}?></td>
                                <td><?php echo  number_format($lista3[$i]['valor'], 2, ",", ".") ?></td>
                                <td><?php echo  number_format($lista3[$i]['saldo'] , 2, ",", ".")?></td>
                                
                            </tr>	
                            <?php
                             }
                             }
                             ?>
                               
                            </tbody>
                        </table>
						</div>
                    </td>
                </tr>
            </table>
            
            <table id="infoEstadisticas" border="0" style="border:0px" >  
            	<tr >
                	<td style="border:0px" ><h2>INFORMACION ESTADISTICA</h2></td>
                </tr>
                <tr>
                	<td style="border:0px" ><!-- TABLA NOMINA POR MES -->
                    <table width="100%">
                        <caption style="font-weight:bold; text-align: left"><h3>NOMINA POR MES AÑO ACTUAL</h3></caption>
                          <thead>
                            <tr class="odd">
                                <th width="22%" scope="col">MES</th>
                                <th width="25%" scope="col">NOMINA</th>
                                
                            </tr>	
                           </thead>
                          
                            <tbody>
				       <?php
    
   
    
     
     //$genera=$obj->hist_quin_nomina();
     if($lista14==null){
	echo "<tr>
	  <td colspan='5'>No hay datos a Mostrar</tr>";
     }else{
     
	  $cont=count($lista14);
           for($i=0; $i<$cont; $i++)
   
      ?>
                            <tr>
                                <td>Enero</td>
                                <td><?php echo "$ ".$tot=number_format(@$lista14[0]["total"]+@$lista14[1]["total"], 2, ",", ".");?></td>
                            </tr>
                            <tr class='odd'>
                                <td>Febrero</td>
                                <td><?php echo "$ ".$tot1=number_format(@$lista14[2]["total"]+@$lista14[3]["total"], 2, ",", ".");?></td>
                            </tr>
                               <tr>
                                <td>Marzo</td>
                                <td><?php echo "$ ".$tot2=number_format(@$lista14[4]["total"]+@$lista14[5]["total"], 2, ",", ".");?></td>
                            </tr>
                            <tr class='odd'>
                                <td>Abril</td>
                                <td><?php echo "$ ".$tot3=number_format(@$lista14[6]["total"]+@$lista14[7]["total"], 2, ",", ".");?></td>
                            </tr>
                                <tr>
                                <td>Mayo</td>
                                <td><?php echo "$ ".$tot4=number_format(@$lista14[8]["total"]+@$lista14[9]["total"], 2, ",", ".");?></td>
                            </tr>
                            <tr class='odd'>
                                <td>Junio</td>
                                <td><?php echo "$ ".$tot5=number_format(@$lista14[10]["total"]+@$lista14[11]["total"], 2, ",", ".");?></td>
                            </tr>
                               <tr>
                                <td>Julio</td>
                                <td><?php echo "$ ".$tot6=number_format(@$lista14[12]["total"]+@$lista14[13]["total"], 2, ",", ".");?></td>
                            </tr>
                            <tr class='odd'>
                                <td>Agosto</td>
                                <td><?php echo "$ ".$tot7=number_format(@$lista14[14]["total"]+@$lista14[15]["total"], 2, ",", ".");?></td>
                            </tr>
                                    <tr>
                                <td>Septiembre</td>
                                <td><?php echo "$ ".$tot8=number_format(@$lista14[16]["total"]+@$lista14[17]["total"], 2, ",", ".");?></td>
                            </tr>
                            <tr class='odd'>
                                <td>Octubre</td>
                                <td><?php echo "$ ".$tot9=number_format(@$lista14[18]["total"]+@$lista14[19]["total"], 2, ",", ".");?></td>
                            </tr>
                               <tr>
                                <td>Nomviembre</td>
                                <td><?php echo "$ ".$tot10=number_format(@$lista14[20]["total"]+@$lista14[21]["total"], 2, ",", ".");?></td>
                            </tr>
                            <tr class='odd'>
                                <td>Diciembre</td>
                                <td><?php echo "$ ".$tot11=number_format(@$lista14[22]["total"]+@$lista14[23]["total"], 2, ",", ".");?></td>
			    </tr>
                             <?php }?>
                            </tbody>
                        </table>
                                      
                    </td>
                </tr>
                <tr>
                	<td style="border:0px" > <!-- TABLA AUSENCIAS POR MES -->
                    	<table width="100%">
                        <caption style="font-weight:bold; text-align: left"><h3>AUSENCIAS POR MES AÑO ACTUAL</h3></caption>
                          <thead>
                            <tr class="odd">
                                <th width="22%" scope="col" >MES</th>
                                <th width="25%" scope="col">DIAS</th>
                                
                            </tr>	
                           </thead>
                          
			
                            <tbody>
                            <tr>
                                <td><a id="enero" style="color: #D42945">Enero</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){  if(@$lista15[$j]['fecha']=='01-01-'.$year.'' or @$lista15[$j]['fecha']=='01-02-'.$year.'' or @$lista15[$j]['fecha']=='01-03-'.$year.'' or @$lista15[$j]['fecha']=='01-04-'.$year.'' or @$lista15[$j]['fecha']=='01-05-'.$year.'' or @$lista15[$j]['fecha']=='01-06-'.$year.'' or @$lista15[$j]['fecha']=='01-07-'.$year.'' or @$lista15[$j]['fecha']=='01-08-'.$year.'' or @$lista15[$j]['fecha']=='01-09-'.$year.'' or @$lista15[$j]['fecha']=='01-10-'.$year.'' or @$lista15[$j]['fecha']=='01-11-'.$year.'' or @$lista15[$j]['fecha']=='01-12-'.$year.'' or @$lista15[$j]['fecha']=='01-13-'.$year.'' or @$lista15[$j]['fecha']=='01-14-'.$year.'' or @$lista15[$j]['fecha']=='01-15-'.$year.'' or @$lista15[$j]['fecha']=='01-16-'.$year.'' or @$lista15[$j]['fecha']=='01-17-'.$year.'' or @$lista15[$j]['fecha']=='01-18-'.$year.'' or @$lista15[$j]['fecha']=='01-19-'.$year.'' or @$lista15[$j]['fecha']=='01-20-'.$year.'' or @$lista15[$j]['fecha']=='01-21-'.$year.'' or @$lista15[$j]['fecha']=='01-22-'.$year.'' or @$lista15[$j]['fecha']=='01-23-'.$year.'' or @$lista15[$j]['fecha']=='01-24-'.$year.'' or @$lista15[$j]['fecha']=='01-25-'.$year.'' or @$lista15[$j]['fecha']=='01-26-'.$year.'' or @$lista15[$j]['fecha']=='01-27-'.$year.'' or @$lista15[$j]['fecha']=='01-28-'.$year.'' or @$lista15[$j]['fecha']=='01-29-'.$year.'' or @$lista15[$j]['fecha']=='01-30-'.$year.'' or @$lista15[$j]['fecha']=='01-31-'.$year.'' ){  @$a=@$a+$lista15[$j]['dias']; }}if(@$a==NULL){echo "0"; }else{echo @$a;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="febrero" style="color: #D42945">Febrero</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){   if(@$lista15[$j]['fecha']=='02-01-'.$year.'' or @$lista15[$j]['fecha']=='02-02-'.$year.'' or @$lista15[$j]['fecha']=='02-03-'.$year.'' or @$lista15[$j]['fecha']=='02-04-'.$year.'' or @$lista15[$j]['fecha']=='02-05-'.$year.'' or @$lista15[$j]['fecha']=='02-06-'.$year.'' or @$lista15[$j]['fecha']=='02-07-'.$year.'' or @$lista15[$j]['fecha']=='02-08-'.$year.'' or @$lista15[$j]['fecha']=='02-09-'.$year.'' or @$lista15[$j]['fecha']=='02-10-'.$year.'' or @$lista15[$j]['fecha']=='02-11-'.$year.'' or @$lista15[$j]['fecha']=='02-12-'.$year.'' or @$lista15[$j]['fecha']=='02-13-'.$year.'' or @$lista15[$j]['fecha']=='02-14-'.$year.'' or @$lista15[$j]['fecha']=='02-15-'.$year.'' or @$lista15[$j]['fecha']=='02-16-'.$year.'' or @$lista15[$j]['fecha']=='02-17-'.$year.'' or @$lista15[$j]['fecha']=='02-18-'.$year.'' or @$lista15[$j]['fecha']=='02-19-'.$year.'' or @$lista15[$j]['fecha']=='02-20-'.$year.'' or @$lista15[$j]['fecha']=='02-21-'.$year.'' or @$lista15[$j]['fecha']=='02-22-'.$year.'' or @$lista15[$j]['fecha']=='02-23-'.$year.'' or @$lista15[$j]['fecha']=='02-24-'.$year.'' or @$lista15[$j]['fecha']=='02-25-'.$year.'' or @$lista15[$j]['fecha']=='02-26-'.$year.'' or @$lista15[$j]['fecha']=='02-27-'.$year.'' or @$lista15[$j]['fecha']=='02-28-'.$year.'' or @$lista15[$j]['fecha']=='02-29-'.$year.'' or @$lista15[$j]['fecha']=='02-30-'.$year.'' or @$lista15[$j]['fecha']=='02-31-'.$year.'' ){ @$b=@$b+$lista15[$j]['dias']; }}if(@$b==NULL){echo "0"; }else{echo @$b;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="marzo" style="color: #D42945">Marzo</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='03-01-'.$year.'' or @$lista15[$j]['fecha']=='03-02-'.$year.'' or @$lista15[$j]['fecha']=='03-03-'.$year.'' or @$lista15[$j]['fecha']=='03-04-'.$year.'' or @$lista15[$j]['fecha']=='03-05-'.$year.'' or @$lista15[$j]['fecha']=='03-06-'.$year.'' or @$lista15[$j]['fecha']=='03-07-'.$year.'' or @$lista15[$j]['fecha']=='03-08-'.$year.'' or @$lista15[$j]['fecha']=='03-09-'.$year.'' or @$lista15[$j]['fecha']=='03-10-'.$year.'' or @$lista15[$j]['fecha']=='03-11-'.$year.'' or @$lista15[$j]['fecha']=='03-12-'.$year.'' or @$lista15[$j]['fecha']=='03-13-'.$year.'' or @$lista15[$j]['fecha']=='03-14-'.$year.'' or @$lista15[$j]['fecha']=='03-15-'.$year.'' or @$lista15[$j]['fecha']=='03-16-'.$year.'' or @$lista15[$j]['fecha']=='03-17-'.$year.'' or @$lista15[$j]['fecha']=='03-18-'.$year.'' or @$lista15[$j]['fecha']=='03-19-'.$year.'' or @$lista15[$j]['fecha']=='03-20-'.$year.'' or @$lista15[$j]['fecha']=='03-21-'.$year.'' or @$lista15[$j]['fecha']=='03-22-'.$year.'' or @$lista15[$j]['fecha']=='03-23-'.$year.'' or @$lista15[$j]['fecha']=='03-24-'.$year.'' or @$lista15[$j]['fecha']=='03-25-'.$year.'' or @$lista15[$j]['fecha']=='03-26-'.$year.'' or @$lista15[$j]['fecha']=='03-27-'.$year.'' or @$lista15[$j]['fecha']=='03-28-'.$year.'' or @$lista15[$j]['fecha']=='03-29-'.$year.'' or @$lista15[$j]['fecha']=='03-30-'.$year.'' or @$lista15[$j]['fecha']=='03-31-'.$year.'' ){ @$c=@$c+$lista15[$j]['dias']; }}if(@$c==NULL){echo "0"; }else{echo @$c;} ?></td>
                            </tr>
                            <tr>
                                <td><a id="abril" style="color: #D42945">Abril</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='04-01-'.$year.'' or @$lista15[$j]['fecha']=='04-02-'.$year.'' or @$lista15[$j]['fecha']=='04-03-'.$year.'' or @$lista15[$j]['fecha']=='04-04-'.$year.'' or @$lista15[$j]['fecha']=='04-05-'.$year.'' or @$lista15[$j]['fecha']=='04-06-'.$year.'' or @$lista15[$j]['fecha']=='04-07-'.$year.'' or @$lista15[$j]['fecha']=='04-08-'.$year.'' or @$lista15[$j]['fecha']=='04-09-'.$year.'' or @$lista15[$j]['fecha']=='04-10-'.$year.'' or @$lista15[$j]['fecha']=='04-11-'.$year.'' or @$lista15[$j]['fecha']=='04-12-'.$year.'' or @$lista15[$j]['fecha']=='04-13-'.$year.'' or @$lista15[$j]['fecha']=='04-14-'.$year.'' or @$lista15[$j]['fecha']=='04-15-'.$year.'' or @$lista15[$j]['fecha']=='04-16-'.$year.'' or @$lista15[$j]['fecha']=='04-17-'.$year.'' or @$lista15[$j]['fecha']=='04-18-'.$year.'' or @$lista15[$j]['fecha']=='04-19-'.$year.'' or @$lista15[$j]['fecha']=='04-20-'.$year.'' or @$lista15[$j]['fecha']=='04-21-'.$year.'' or @$lista15[$j]['fecha']=='04-22-'.$year.'' or @$lista15[$j]['fecha']=='04-23-'.$year.'' or @$lista15[$j]['fecha']=='04-24-'.$year.'' or @$lista15[$j]['fecha']=='04-25-'.$year.'' or @$lista15[$j]['fecha']=='04-26-'.$year.'' or @$lista15[$j]['fecha']=='04-27-'.$year.'' or @$lista15[$j]['fecha']=='04-28-'.$year.'' or @$lista15[$j]['fecha']=='04-29-'.$year.'' or @$lista15[$j]['fecha']=='04-30-'.$year.'' or @$lista15[$j]['fecha']=='04-31-'.$year.'' ){ @$d=@$d+$lista15[$j]['dias']; }}if(@$d==NULL){echo "0"; }else{echo @$d;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="mayo" style="color: #D42945">Mayo</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='05-01-'.$year.'' or @$lista15[$j]['fecha']=='05-02-'.$year.'' or @$lista15[$j]['fecha']=='05-03-'.$year.'' or @$lista15[$j]['fecha']=='05-04-'.$year.'' or @$lista15[$j]['fecha']=='05-05-'.$year.'' or @$lista15[$j]['fecha']=='05-06-'.$year.'' or @$lista15[$j]['fecha']=='05-07-'.$year.'' or @$lista15[$j]['fecha']=='05-08-'.$year.'' or @$lista15[$j]['fecha']=='05-09-'.$year.'' or @$lista15[$j]['fecha']=='05-10-'.$year.'' or @$lista15[$j]['fecha']=='05-11-'.$year.'' or @$lista15[$j]['fecha']=='05-12-'.$year.'' or @$lista15[$j]['fecha']=='05-13-'.$year.'' or @$lista15[$j]['fecha']=='05-14-'.$year.'' or @$lista15[$j]['fecha']=='05-15-'.$year.'' or @$lista15[$j]['fecha']=='05-16-'.$year.'' or @$lista15[$j]['fecha']=='05-17-'.$year.'' or @$lista15[$j]['fecha']=='05-18-'.$year.'' or @$lista15[$j]['fecha']=='05-19-'.$year.'' or @$lista15[$j]['fecha']=='05-20-'.$year.'' or @$lista15[$j]['fecha']=='05-21-'.$year.'' or @$lista15[$j]['fecha']=='05-22-'.$year.'' or @$lista15[$j]['fecha']=='05-23-'.$year.'' or @$lista15[$j]['fecha']=='05-24-'.$year.'' or @$lista15[$j]['fecha']=='05-25-'.$year.'' or @$lista15[$j]['fecha']=='05-26-'.$year.'' or @$lista15[$j]['fecha']=='05-27-'.$year.'' or @$lista15[$j]['fecha']=='05-28-'.$year.'' or @$lista15[$j]['fecha']=='05-29-'.$year.'' or @$lista15[$j]['fecha']=='05-30-'.$year.'' or @$lista15[$j]['fecha']=='05-31-'.$year.'' ){ @$e=@$e+$lista15[$j]['dias']; }}if(@$e==NULL){echo "0"; }else{echo @$e;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="junio" style="color: #D42945">Junio</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='06-01-'.$year.'' or @$lista15[$j]['fecha']=='06-02-'.$year.'' or @$lista15[$j]['fecha']=='06-03-'.$year.'' or @$lista15[$j]['fecha']=='06-04-'.$year.'' or @$lista15[$j]['fecha']=='06-05-'.$year.'' or @$lista15[$j]['fecha']=='06-06-'.$year.'' or @$lista15[$j]['fecha']=='06-07-'.$year.'' or @$lista15[$j]['fecha']=='06-08-'.$year.'' or @$lista15[$j]['fecha']=='06-09-'.$year.'' or @$lista15[$j]['fecha']=='06-10-'.$year.'' or @$lista15[$j]['fecha']=='06-11-'.$year.'' or @$lista15[$j]['fecha']=='06-12-'.$year.'' or @$lista15[$j]['fecha']=='06-13-'.$year.'' or @$lista15[$j]['fecha']=='06-14-'.$year.'' or @$lista15[$j]['fecha']=='06-15-'.$year.'' or @$lista15[$j]['fecha']=='06-16-'.$year.'' or @$lista15[$j]['fecha']=='06-17-'.$year.'' or @$lista15[$j]['fecha']=='06-18-'.$year.'' or @$lista15[$j]['fecha']=='06-19-'.$year.'' or @$lista15[$j]['fecha']=='06-20-'.$year.'' or @$lista15[$j]['fecha']=='06-21-'.$year.'' or @$lista15[$j]['fecha']=='06-22-'.$year.'' or @$lista15[$j]['fecha']=='06-23-'.$year.'' or @$lista15[$j]['fecha']=='06-24-'.$year.'' or @$lista15[$j]['fecha']=='06-25-'.$year.'' or @$lista15[$j]['fecha']=='06-26-'.$year.'' or @$lista15[$j]['fecha']=='06-27-'.$year.'' or @$lista15[$j]['fecha']=='06-28-'.$year.'' or @$lista15[$j]['fecha']=='06-29-'.$year.'' or @$lista15[$j]['fecha']=='06-30-'.$year.'' or @$lista15[$j]['fecha']=='06-31-'.$year.'' ){ @$f=@$f+$lista15[$j]['dias']; }}if(@$f==NULL){echo "0"; }else{echo @$f;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="julio" style="color: #D42945">Julio</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='07-01-'.$year.'' or @$lista15[$j]['fecha']=='07-02-'.$year.'' or @$lista15[$j]['fecha']=='07-03-'.$year.'' or @$lista15[$j]['fecha']=='07-04-'.$year.'' or @$lista15[$j]['fecha']=='07-05-'.$year.'' or @$lista15[$j]['fecha']=='07-06-'.$year.'' or @$lista15[$j]['fecha']=='07-07-'.$year.'' or @$lista15[$j]['fecha']=='07-08-'.$year.'' or @$lista15[$j]['fecha']=='07-09-'.$year.'' or @$lista15[$j]['fecha']=='07-10-'.$year.'' or @$lista15[$j]['fecha']=='07-11-'.$year.'' or @$lista15[$j]['fecha']=='07-12-'.$year.'' or @$lista15[$j]['fecha']=='07-13-'.$year.'' or @$lista15[$j]['fecha']=='07-14-'.$year.'' or @$lista15[$j]['fecha']=='07-15-'.$year.'' or @$lista15[$j]['fecha']=='07-16-'.$year.'' or @$lista15[$j]['fecha']=='07-17-'.$year.'' or @$lista15[$j]['fecha']=='07-18-'.$year.'' or @$lista15[$j]['fecha']=='07-19-'.$year.'' or @$lista15[$j]['fecha']=='07-20-'.$year.'' or @$lista15[$j]['fecha']=='07-21-'.$year.'' or @$lista15[$j]['fecha']=='07-22-'.$year.'' or @$lista15[$j]['fecha']=='07-23-'.$year.'' or @$lista15[$j]['fecha']=='07-24-'.$year.'' or @$lista15[$j]['fecha']=='07-25-'.$year.'' or @$lista15[$j]['fecha']=='07-26-'.$year.'' or @$lista15[$j]['fecha']=='07-27-'.$year.'' or @$lista15[$j]['fecha']=='07-28-'.$year.'' or @$lista15[$j]['fecha']=='07-29-'.$year.'' or @$lista15[$j]['fecha']=='07-30-'.$year.'' or @$lista15[$j]['fecha']=='07-31-'.$year.'' ){ @$g=@$g+$lista15[$j]['dias']; }}if(@$g==NULL){echo "0"; }else{echo @$g;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="agosto" style="color: #D42945">Agosto</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='08-01-'.$year.'' or @$lista15[$j]['fecha']=='08-02-'.$year.'' or @$lista15[$j]['fecha']=='08-03-'.$year.'' or @$lista15[$j]['fecha']=='08-04-'.$year.'' or @$lista15[$j]['fecha']=='08-05-'.$year.'' or @$lista15[$j]['fecha']=='08-06-'.$year.'' or @$lista15[$j]['fecha']=='08-07-'.$year.'' or @$lista15[$j]['fecha']=='08-08-'.$year.'' or @$lista15[$j]['fecha']=='08-09-'.$year.'' or @$lista15[$j]['fecha']=='08-10-'.$year.'' or @$lista15[$j]['fecha']=='08-11-'.$year.'' or @$lista15[$j]['fecha']=='08-12-'.$year.'' or @$lista15[$j]['fecha']=='08-13-'.$year.'' or @$lista15[$j]['fecha']=='08-14-'.$year.'' or @$lista15[$j]['fecha']=='08-15-'.$year.'' or @$lista15[$j]['fecha']=='08-16-'.$year.'' or @$lista15[$j]['fecha']=='08-17-'.$year.'' or @$lista15[$j]['fecha']=='08-18-'.$year.'' or @$lista15[$j]['fecha']=='08-19-'.$year.'' or @$lista15[$j]['fecha']=='08-20-'.$year.'' or @$lista15[$j]['fecha']=='08-21-'.$year.'' or @$lista15[$j]['fecha']=='08-22-'.$year.'' or @$lista15[$j]['fecha']=='08-23-'.$year.'' or @$lista15[$j]['fecha']=='08-24-'.$year.'' or @$lista15[$j]['fecha']=='08-25-'.$year.'' or @$lista15[$j]['fecha']=='08-26-'.$year.'' or @$lista15[$j]['fecha']=='08-27-'.$year.'' or @$lista15[$j]['fecha']=='08-28-'.$year.'' or @$lista15[$j]['fecha']=='08-29-'.$year.'' or @$lista15[$j]['fecha']=='08-30-'.$year.'' or @$lista15[$j]['fecha']=='08-31-'.$year.'' ){ @$h=@$h+$lista15[$j]['dias']; }}if(@$h==NULL){echo "0"; }else{echo @$h;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="septiembre" style="color: #D42945">Septiembre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='09-01-'.$year.'' or @$lista15[$j]['fecha']=='09-02-'.$year.'' or @$lista15[$j]['fecha']=='09-03-'.$year.'' or @$lista15[$j]['fecha']=='09-04-'.$year.'' or @$lista15[$j]['fecha']=='09-05-'.$year.'' or @$lista15[$j]['fecha']=='09-06-'.$year.'' or @$lista15[$j]['fecha']=='09-07-'.$year.'' or @$lista15[$j]['fecha']=='09-08-'.$year.'' or @$lista15[$j]['fecha']=='09-09-'.$year.'' or @$lista15[$j]['fecha']=='09-10-'.$year.'' or @$lista15[$j]['fecha']=='09-11-'.$year.'' or @$lista15[$j]['fecha']=='09-12-'.$year.'' or @$lista15[$j]['fecha']=='09-13-'.$year.'' or @$lista15[$j]['fecha']=='09-14-'.$year.'' or @$lista15[$j]['fecha']=='09-15-'.$year.'' or @$lista15[$j]['fecha']=='09-16-'.$year.'' or @$lista15[$j]['fecha']=='09-17-'.$year.'' or @$lista15[$j]['fecha']=='09-18-'.$year.'' or @$lista15[$j]['fecha']=='09-19-'.$year.'' or @$lista15[$j]['fecha']=='09-20-'.$year.'' or @$lista15[$j]['fecha']=='09-21-'.$year.'' or @$lista15[$j]['fecha']=='09-22-'.$year.'' or @$lista15[$j]['fecha']=='09-23-'.$year.'' or @$lista15[$j]['fecha']=='09-24-'.$year.'' or @$lista15[$j]['fecha']=='09-25-'.$year.'' or @$lista15[$j]['fecha']=='09-26-'.$year.'' or @$lista15[$j]['fecha']=='09-27-'.$year.'' or @$lista15[$j]['fecha']=='09-28-'.$year.'' or @$lista15[$j]['fecha']=='09-29-'.$year.'' or @$lista15[$j]['fecha']=='09-30-'.$year.'' or @$lista15[$j]['fecha']=='09-31-'.$year.'' ){ @$k=@$k+$lista15[$j]['dias']; }}if(@$k==NULL){echo "0"; }else{echo @$k;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="octubre" style="color: #D42945">Octubre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='10-01-'.$year.'' or @$lista15[$j]['fecha']=='10-02-'.$year.'' or @$lista15[$j]['fecha']=='10-03-'.$year.'' or @$lista15[$j]['fecha']=='10-04-'.$year.'' or @$lista15[$j]['fecha']=='10-05-'.$year.'' or @$lista15[$j]['fecha']=='10-06-'.$year.'' or @$lista15[$j]['fecha']=='10-07-'.$year.'' or @$lista15[$j]['fecha']=='10-08-'.$year.'' or @$lista15[$j]['fecha']=='10-09-'.$year.'' or @$lista15[$j]['fecha']=='10-10-'.$year.'' or @$lista15[$j]['fecha']=='10-11-'.$year.'' or @$lista15[$j]['fecha']=='10-12-'.$year.'' or @$lista15[$j]['fecha']=='10-13-'.$year.'' or @$lista15[$j]['fecha']=='10-14-'.$year.'' or @$lista15[$j]['fecha']=='10-15-'.$year.'' or @$lista15[$j]['fecha']=='10-16-'.$year.'' or @$lista15[$j]['fecha']=='10-17-'.$year.'' or @$lista15[$j]['fecha']=='10-18-'.$year.'' or @$lista15[$j]['fecha']=='10-19-'.$year.'' or @$lista15[$j]['fecha']=='10-20-'.$year.'' or @$lista15[$j]['fecha']=='10-21-'.$year.'' or @$lista15[$j]['fecha']=='10-22-'.$year.'' or @$lista15[$j]['fecha']=='10-23-'.$year.'' or @$lista15[$j]['fecha']=='10-24-'.$year.'' or @$lista15[$j]['fecha']=='10-25-'.$year.'' or @$lista15[$j]['fecha']=='10-26-'.$year.'' or @$lista15[$j]['fecha']=='10-27-'.$year.'' or @$lista15[$j]['fecha']=='10-28-'.$year.'' or @$lista15[$j]['fecha']=='10-29-'.$year.'' or @$lista15[$j]['fecha']=='10-30-'.$year.'' or @$lista15[$j]['fecha']=='10-31-'.$year.'' ){ @$m=@$m+$lista15[$j]['dias']; }}if(@$m==NULL){echo "0"; }else{echo @$m;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="noviembre" style="color: #D42945">Noviembre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='11-01-'.$year.'' or @$lista15[$j]['fecha']=='11-02-'.$year.'' or @$lista15[$j]['fecha']=='11-03-'.$year.'' or @$lista15[$j]['fecha']=='11-04-'.$year.'' or @$lista15[$j]['fecha']=='11-05-'.$year.'' or @$lista15[$j]['fecha']=='11-06-'.$year.'' or @$lista15[$j]['fecha']=='11-07-'.$year.'' or @$lista15[$j]['fecha']=='11-08-'.$year.'' or @$lista15[$j]['fecha']=='11-09-'.$year.'' or @$lista15[$j]['fecha']=='11-10-'.$year.'' or @$lista15[$j]['fecha']=='11-11-'.$year.'' or @$lista15[$j]['fecha']=='11-12-'.$year.'' or @$lista15[$j]['fecha']=='11-13-'.$year.'' or @$lista15[$j]['fecha']=='11-14-'.$year.'' or @$lista15[$j]['fecha']=='11-15-'.$year.'' or @$lista15[$j]['fecha']=='11-16-'.$year.'' or @$lista15[$j]['fecha']=='11-17-'.$year.'' or @$lista15[$j]['fecha']=='11-18-'.$year.'' or @$lista15[$j]['fecha']=='11-19-'.$year.'' or @$lista15[$j]['fecha']=='11-20-'.$year.'' or @$lista15[$j]['fecha']=='11-21-'.$year.'' or @$lista15[$j]['fecha']=='11-22-'.$year.'' or @$lista15[$j]['fecha']=='11-23-'.$year.'' or @$lista15[$j]['fecha']=='11-24-'.$year.'' or @$lista15[$j]['fecha']=='11-25-'.$year.'' or @$lista15[$j]['fecha']=='11-26-'.$year.'' or @$lista15[$j]['fecha']=='11-27-'.$year.'' or @$lista15[$j]['fecha']=='11-28-'.$year.'' or @$lista15[$j]['fecha']=='11-29-'.$year.'' or @$lista15[$j]['fecha']=='11-30-'.$year.'' or @$lista15[$j]['fecha']=='11-31-'.$year.'' ){ @$n=@$n+$lista15[$j]['dias']; }}if(@$n==NULL){echo "0"; }else{echo @$n;} ?></td>
			    </tr>
                            <tr>
                                <td><a id="diciembre" style="color: #D42945">Diciembre</a></td>
                                <td><?php for($j=0; $j<count($lista15); $j++){ if(@$lista15[$j]['fecha']=='12-01-'.$year.'' or @$lista15[$j]['fecha']=='12-02-'.$year.'' or @$lista15[$j]['fecha']=='12-03-'.$year.'' or @$lista15[$j]['fecha']=='12-04-'.$year.'' or @$lista15[$j]['fecha']=='12-05-'.$year.'' or @$lista15[$j]['fecha']=='12-06-'.$year.'' or @$lista15[$j]['fecha']=='12-07-'.$year.'' or @$lista15[$j]['fecha']=='12-08-'.$year.'' or @$lista15[$j]['fecha']=='12-09-'.$year.'' or @$lista15[$j]['fecha']=='12-10-'.$year.'' or @$lista15[$j]['fecha']=='12-11-'.$year.'' or @$lista15[$j]['fecha']=='12-12-'.$year.'' or @$lista15[$j]['fecha']=='12-13-'.$year.'' or @$lista15[$j]['fecha']=='12-14-'.$year.'' or @$lista15[$j]['fecha']=='12-15-'.$year.'' or @$lista15[$j]['fecha']=='12-16-'.$year.'' or @$lista15[$j]['fecha']=='12-17-'.$year.'' or @$lista15[$j]['fecha']=='12-18-'.$year.'' or @$lista15[$j]['fecha']=='12-19-'.$year.'' or @$lista15[$j]['fecha']=='12-20-'.$year.'' or @$lista15[$j]['fecha']=='12-21-'.$year.'' or @$lista15[$j]['fecha']=='12-22-'.$year.'' or @$lista15[$j]['fecha']=='12-23-'.$year.'' or @$lista15[$j]['fecha']=='12-24-'.$year.'' or @$lista15[$j]['fecha']=='12-25-'.$year.'' or @$lista15[$j]['fecha']=='12-26-'.$year.'' or @$lista15[$j]['fecha']=='12-27-'.$year.'' or @$lista15[$j]['fecha']=='12-28-'.$year.'' or @$lista15[$j]['fecha']=='12-29-'.$year.'' or @$lista15[$j]['fecha']=='12-30-'.$year.'' or @$lista15[$j]['fecha']=='12-31-'.$year.'' ){ @$p=@$p+$lista15[$j]['dias']; }}if(@$p==NULL){echo "0"; }else{echo @$p;} ?></td>
			    </tr>
                                                    
                            </tbody>
                        </table>
                                     
                   </td>
                </tr>
            </table>
        </td>
	</tr>
</table>

</body>
</html>
