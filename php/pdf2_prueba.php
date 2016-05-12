<?php 
session_start();

@$_SESSION['cor'];        
     


require_once('../html2pdf/html2pdf.class.php');
require_once('../lib/configdb.php');

// require_once('../pjmail/pjmail.class.php'); 

require_once('class_mailer_externo.php');

$mail = new mailer();

$anio_formu=$_POST['anio'];

//sentencia repetida
$qry_valida="select ano from certificado_rtefte where ano='".$anio_formu."'";

$rh90 = $conn->Execute($qry_valida); 

$row90 = $rh90->FetchRow();

@$ano_valida=$row90["ano"];





/*
 *esta todo el negocio del comprobante
 */
include("class_comprobante.php");

    //Llamos la clase contenedra de los datos del comprobante
     $com=new comprobante();

		

//var_dump($anio_formu);die("");

//Query que retorna la informacion de la empresa
$qry1="SELECT emp.nom_emp,emp.dir_emp,emp.nit_emp,emp.digito_ver,ciu.cod_ciu_iss,ciu.cod_dpt,ciu.nom_ciu,depa.nom_dpt,tel_1 
FROM empresas emp,ciudades ciu,dpto_pais depa 
--INTO :str_nom_emp,:str_dir_emp,:str_nit,:str_digito_ver,:str_cod_ciu,:str_cod_dpt,:str_ciu,:str_depar,:str_tel_emp
WHERE emp.cod_ciu=ciu.cod_ciu
		               	AND ciu.cod_dpt=depa.cod_dpt
						AND emp.cod_emp='1'";

$rh1 = $conn->Execute($qry1); 

$row1 = $rh1->FetchRow();

$nombre_empresa=utf8_encode($row1["nom_emp"]);
$nit_empresa=$row1["nit_emp"];
$nom_ciudad=$row1["nom_ciu"];
$cod_departamento=$row1["cod_dpt"];
$cod_ciudad=$row1["cod_ciu_iss"];
$digito=$row1["digito_ver"];



$qry3="SELECT e.cedula ced,sum((case when c.dev_ded='D' then -1 else 1 end)*h.valor) vlr,sum((case when c.dev_ded='D' then 1 else 0 end)*h.valor) vlr1,cyr.fila fil, e.ape_epl ape,e.nom_epl nom, cyr.prc porc,e.cod_dep, e.cod_emp,e.cod_cc,e.cod_cc2,e.ciu_tra
 FROM  historia_liq h,conceptos c,empleados_basic e,concep_fc cyr
 WHERE  h.cod_epl between '".@$_SESSION['ced']."' and '".@$_SESSION['ced']."' 
AND  h.cod_epl = e.cod_epl
			       AND h.cod_con = c.cod_con
		           AND  h.ano = '".$anio_formu."'
			        AND cyr.cod_con=h.cod_con
		           GROUP BY  e.cod_dep,e.ape_epl,e.nom_epl,e.cedula,cyr.fila,
                  h.cod_epl,cyr.prc,e.cod_dep,e.cod_emp,e.cod_cc,e.cod_cc2,e.ciu_tra";
				  
$rh3 = $conn->Execute($qry3); 

$valor1=0;
$valor2=0;
$valor3=0;
$valor4=0;
$valor5=0;
$valor6=0;
$valor7=0;
$valor8=0;
$valor9=0;
$valorNe1=0;
$valorNe2=0;

while($row3 = $rh3->FetchRow()){


if($row3['fil']==1){
			
			if($valor1==0){ $valor1=$row3['vlr'];}
		
	}

		if($row3['fil']==2){
			$valor2=$row3['vlr'];
		
}	

		if($row3['fil']==3){
			$valor3=$row3['vlr'];
		
		}
		

		if($row3['fil']==4){
			$valor4=$row3['vlr'];
		
}	

		if($row3['fil']==5){
			$valor5=$row3['vlr'];
		
}	

		if($row3['fil']==6){
			$valorNe1=$row3['vlr'];
			$valor6=$valorNe1*-1;
}	

		if($row3['fil']==7){
			$valorNe2=$row3['vlr'];
			$valor7=$valorNe2*-1;
}	

		if($row3['fil']==8){
			$valorNe3=$row3['vlr'];
			$valor8=$valorNe3*-1;
		
}
		if($row3['fil']==9){
			$valorNe4=$row3['vlr'];
			$valor9=$valorNe4*-1;
		
}

}

$sumatoria=$valor1+$valor2+$valor3+$valor4+$valor5;
//$fecha_actual=date("Y  m  d");



//sentencia repetida
$qrynew="select convert(varchar(20),fecha_cert,102) as fecha_cert from certificado_rtefte where ano='".$anio_formu."'";

		  
$rhnew = $conn->Execute($qrynew); 

$rownew = $rhnew->FetchRow();

$fecha_actual=$rownew["fecha_cert"];


$anio=substr($fecha_actual, 0, 4);

$mes=substr($fecha_actual, 5, 2);

$dia=substr($fecha_actual, 8, 2);

//var_dump($dia);die("");

//var_dump(date_format($fecha_actual,'%Y%m%d'));die("");



$qry4="select *, convert(varchar(20),ini_cto,102) as StartTime, convert(varchar(20),fec_ret,102) as EndTime  from empleados_basic where cedula='".@$_SESSION['ced']."' and estado='A'";

				  
$rh4 = $conn->Execute($qry4); 

$row4 = $rh4->FetchRow();

$cedula=$row4["cedula"];


function cortar_caracter($cadena, $caracter = ' ') { 
  $cadena_cortada=''; // inicializamos 
  for ($i=0;$i<strlen($cadena);$i++) { 
    if ($caracter==$cadena{$i}) { 
      break;  // para salir del bucle 
    } 
    $cadena_cortada=$cadena_cortada.$cadena{$i}; 
  } 
  return $cadena_cortada; 
} 

$apellido=$row4["ape_epl"];


@$pri_apellido=cortar_caracter($apellido,' ');  

@$seg_apellido=strstr($apellido, ' ');


$nombre=$row4["nom_epl"];


@$pri_nombre=cortar_caracter($nombre,' ');  

@$seg_nombre=strstr($nombre, ' ');



$fecha_ini=$row4["StartTime"];

$fecha_fin=$row4["EndTime"];

//2011.02.01


$fecha_parametrizable1=$anio_formu.".01.01 ";

//var_dump($fecha_parametrizable);die("");


if($fecha_ini<$fecha_parametrizable1){

	$fecha1=$anio_formu." &nbsp; 01 &nbsp; 01";

}else{
	//$fecha1=$fecha_ini;

	
	
$anio1=substr($fecha_ini, 0, 4);

$mes1=substr($fecha_ini, 5, 2);

$dia1=substr($fecha_ini, 8, 2);
}



$fecha_parametrizable2=$anio_formu.".12.31 ";

if($fecha_fin< $fecha_parametrizable2 || $fecha_fin=="NULL" || $fecha_fin=="null" ){
    
    
	$fecha2=$anio_formu." &nbsp; 12 &nbsp; 31";
    
}else{
	//$fecha2=$fecha_fin;
	
	
$anio2=substr($fecha_fin, 0, 4);

$mes2=substr($fecha_fin, 5, 2);

$dia2=substr($fecha_fin, 8, 2);
 
}


$qry5="select tipo_doc from empleados_basic where cedula='".@$_SESSION['ced']."'";

		  
$rh5 = $conn->Execute($qry5); 

$row5 = $rh5->FetchRow();

$tipo=$row5["tipo_doc"];

switch($tipo){

case "C":
	$doc="13";
	break;
case "R":
	$doc="11";
	break;
case "T":
	$doc="12";
	break;
case "E":
	$doc="22";
	break;
case "N":
	$doc="31";
	break;
}




//sentencia repetida
$qry6="select * from certificado_rtefte where ano='".$anio_formu."'";



				  
$rh6 = $conn->Execute($qry6); 

$row6 = $rh6->FetchRow();

$nombreRet=$row6["nom_epl_fir"];
$cedulaRet=$row6["cod_epl_fir"];
$ciudadRet=$row6["ciu_exp_fir"];


if(!isset($nombreRet)){
	 echo "False";
	die();
}





$segunda_linea=strtolower($row6["patrimonio_ano"]);
$cuarta_linea=strtolower($row6["ingreso_ano"]);
$quinta_linea=strtolower($row6["tarjetacred_ano"]);
$sexta_linea=strtolower($row6["consumos_ano"]);
$septima_linea=strtolower($row6["consignaciones_ano"]);




/*Contador
$qry7="select count(*) as cantidad from empleados_basic";

$random_number = rand(0,99); 
 
 				  
$rh7 = $conn->Execute($qry7); 

$row7 = $rh7->FetchRow();

$cantidad=$row7["cantidad"];
 
$id=$cantidad + $random_number;
*/


$qry7="SELECT * from parametros_nue WHERE nom_var='t_cnsctvo_rtefte'";



 				  
$rh7 = $conn->Execute($qry7); 

$row7 = $rh7->FetchRow();

$acumulado=$row7["valor"];

$id=$acumulado + 1;

$convertido="000".$id;


$qry8="update parametros_nue set valor='".$id."' where nom_var='t_cnsctvo_rtefte'";

$rh8 = $conn->Execute($qry8); 

$row8 = $rh8->FetchRow();



$content = '
<page backleft="10mm" backtop="10mm" backright="10mm" backbottom="10mm"  
backimg="../imagenes/certificado2.jpg" backimgx="center" backimgy="top" backimgw="100%" footer="page"> 



<div style="position:absolute; top:-3px; left:306px; font-size:10px; background-color:white; font-weight:bold">'.$anio_formu.'</div> 
 
<div style="position:absolute; top:26px; left:400px; font-size:12px"><p>'.$convertido.'</p></div>  
 
 
<div style="position:absolute; top:103px; font-size:8px">'.$nombre_empresa.'</div>  
 
<div style="position:absolute; top:52px; left:117px; font-size:13px"><p>'.$nit_empresa.'</p></div>  
<div style="position:absolute; top:52px; left:192px; font-size:13px"><p>'.$digito.'</p></div> 
<div style="position:absolute; top:121px; left:18px; font-size:13px"><p>'.@$doc.'</p></div>
<div style="position:absolute; top:114px; left:66px; font-size:13px"><p>'.$cedula.'</p></div>


<div style="position:absolute; top:114px; left:255px; font-size:13px"><p>'.@$pri_apellido.'</p></div>
<div style="position:absolute; top:114px; left:370px; font-size:13px"><p>'.@$seg_apellido.'</p></div>

<div style="position:absolute; top:114px; left:490px; font-size:13px"><p>'.@$pri_nombre.'</p></div>
<div style="position:absolute; top:114px; left:600px; font-size:13px"><p>'.@$seg_nombre.'</p></div>


 
<div style="position:absolute; top:149px; left:400px; font-size:13px"><p>'.$nom_ciudad.'</p></div>
<div style="position:absolute; top:149px; left:626px; font-size:13px"><p>'.$cod_departamento.'</p></div>
<div style="position:absolute; top:149px; left:660px; font-size:13px"><p>0&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;&nbsp;'.$cod_ciudad.'</p></div>


<div style="position:absolute; top:208px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor1, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:224px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor2, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:240px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor3, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:256px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor4, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:270px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor5, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:318px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor6, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:332px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor7, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:348px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor8, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:363px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($valor9, 0, ",", ".").'</td></tr></table></div>
<div style="position:absolute; top:285px; left:605px; font-size:11px; width:100px"><table align="right"><tr><td align="right">'.number_format($sumatoria, 0, ",", ".").'</td></tr></table></div>

<div style="position:absolute; top:149px; left:282px; font-size:13px"><p>'.$anio.'</p></div>
<div style="position:absolute; top:149px; left:325px; font-size:13px"><p>'.$mes.'</p></div>
<div style="position:absolute; top:149px; left:350px; font-size:13px"><p>'.$dia.'</p></div>


<div style="position:absolute; top:149px; left:20px; font-size:13px"><p>'.@$anio1.'</p></div>
<div style="position:absolute; top:149px; left:64px; font-size:13px"><p>'.@$mes1.'</p></div>
<div style="position:absolute; top:149px; left:90px; font-size:13px"><p>'.@$dia1.'</p></div>
<div style="position:absolute; top:149px; left:25px; font-size:13px"><p>'.@$fecha1.'</p></div>

<div style="position:absolute; top:149px; left:165px; font-size:13px"><p>'.@$anio2.'</p></div>
<div style="position:absolute; top:149px; left:207px; font-size:13px"><p>'.@$mes2.'</p></div>
<div style="position:absolute; top:149px; left:234px; font-size:13px"><p>'.@$dia2.'</p></div>
<div style="position:absolute; top:149px; left:168px; font-size:13px"><p>'.@$fecha2.'</p></div>

<div style="position:absolute; top:380px; left:60px; font-size:13px"><p>'.$nombreRet.'</p></div>
<div style="position:absolute; top:396px; left:60px; font-size:13px"><p>C.C. '.$cedulaRet.'</p></div>
<div style="position:absolute; top:396px; left:150px; font-size:13px"><p>'.$ciudadRet.'</p></div>





<div style="position:absolute; top:571px; left:110px; font-size:9px; background-color:white; font-weight: bold; color:gray;">'.$anio_formu.'&nbsp;</div>

<div style="position:absolute; top:724px; left:145px; font-size:9px; background-color:green; font-weight:bold; color:white;">'.$anio_formu.'</div>



<div style="position:absolute; top:838px; left:122px; font-size:8px; background-color:white; font-weight:bold; color:gray;">'.$anio_formu.'</div>


<div style="position:absolute; top:861px; left:136px; font-size:7px; background-color:white; font-weight:bold; color:gray; height:10px">'.htmlentities($segunda_linea).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="position:absolute; top:854px; left:294px; font-size:7px; color:gray; font-weight:bold; height:10px"><p>a diciembre 31 de '.$anio_formu.'</p></div>


<div style="position:absolute; top:883px; left:162px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$cuarta_linea.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div style="position:absolute; top:894px; left:230px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$quinta_linea.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div style="position:absolute; top:906px; left:226px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$sexta_linea.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


<div style="position:absolute; top:917px; left:345px; font-size:7px; background-color:white; font-weight:bold; color:gray;">'.$septima_linea.'&nbsp;&nbsp;&nbsp;&nbsp;</div>






<div style="position:absolute; top:927px; left:388px; font-size:8px; background-color:white; font-weight:bold; color:gray;">'.$anio_formu.'</div> 





<page_footer></page_footer>  
</page>  ';

    
	if(isset($_POST['ver'])){
    $html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
	$html2pdf->Output('Certificado.pdf', 'I');
}else
	if($_POST['envio']){
	$html2pdf = new HTML2PDF('P','A4','en');
    $html2pdf->WriteHTML($content);
	$content_PDF=$html2pdf->Output('',true);
	

 	// $mail = new PJmail(); 
 	// $mail->setAllFrom(utf8_encode($com->empresa(2)), "Centro Medico Imbanaco"); 
 	// $mail->addrecipient(@$_SESSION['cor']);
	
 	// $mail->addsubject("Certificado"); 
 	// $empleado=@$_SESSION['nom'].' '.@$_SESSION['ape'];
 	// $mail->text = "Señor / Señora ".$empleado." le enviamos su Certificado de Ingresos.";
 	// $mail->addbinattachement("certificado.pdf", $content_PDF); 
 	// $res = $mail->sendmail(); 
	
	  //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
       $mail->AddAddress(@$_SESSION['cor']); // Esta es la dirección a donde enviamos @$_SESSION['cor']
       $mail->IsHTML(true); // El correo se envía como HTML
       $mail->Subject = "Envio de Certificado de Ingresos y Retenciones"; // Este es el titulo del email.
       $empleado=@$_SESSION['cor'];
       $body = "Señor(a) ".$_SESSION['cor']." Su Certificado de Ingresos y Retenciones es:<br><br><br>";
       $mail->Body = "Se le hace entrega de su respectivo Certificado de Ingresos y Retenciones."; // Mensaje a enviar
        $mail->AddStringAttachment($content_PDF,"comprobante.pdf"); //me permite enviar archivos adjuntos sin necesidad de indicar ruta 
       $exito = $mail->Send(); // Envía el correo.
       //También podríamos agregar simples verificaciones para saber si se envió:
        if($exito){
            echo "True";
			//window.close();
			
          }else{
            echo '<script>alert("Hubo un inconveniente. Contacta a un administrador."); window.close();</script>';
          }
  
	
	
	 		
	
	
		
	}
	
?>


