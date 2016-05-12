<?php
ob_start();


/*
 *libreria para enviar correos electronicos 
 */
//require_once('../pjmail/pjmail.class.php');


require_once('class_mailer_externo.php');

$mail = new mailer();

/*
 *esta todo el negocio del comprobante
 */
include("class_comprobante.php");


    //Llamos la clase contenedra de los datos del comprobante

     

    $html = ob_get_clean();	 
    
    //Envio los datos a la clase para generar la consulta
 
        
        if($_POST["ano"]==-1 ||  $_POST["per"]==-1 || $_POST["tipo"]==-1 || @$_POST['checkall']==''){
            echo "hola";
	    
        }else{
            
            //$anio=$_POST['anio'];

$cedulas=array();
$datos=array();


$cedulas=$_POST['checkall'];





for($j=0;$j<count($cedulas);$j++){


		set_time_limit(0);

/*
 *Librerias para crear reportes en pdf (html)
 */
require_once('../tcpdf/config/lang/spa.php');
require_once('../tcpdf/tcpdf.php');


     $com=new comprobante();
     
     $pdf =  new TCPDF("P", "mm", "A4", true, "UTF-8", false);
	 
     $email=$com->email_empleado($cedulas[$j]).",";

	 
$com->set_ano($_POST["ano"]);
        $com->set_liq_ini("01");
        $com->set_per_ini($_POST["per"]);
        $com->set_tip_pag($_POST["tipo"]);
	$com->set_codigo($cedulas[$j]);
        
        
		$ra=0;
		$ra1=$com->get_ano();
		$ra2=$com->get_liq_ini();
		$ra3=$com->get_per_ini();
		$ra4=$com->get_tip_pag();
		$ra5=$com->get_cod_emp();
		$ra6=$com->get_codigo();
		
		
		
		//var_dump($ra);die("");
        $com->return_sql($ra6,$ra1,$ra2,$ra3,$ra4);
		$com->comprobante();
        $generar=$com->get_lista();
        
        
        if($generar==null){
            
            echo "<script>
            alert('No se encontraron datos');
            
            
            
            
            </script>";
          
            
        }else{
    
    
    // crear nuevo documento  PDF 

  
    
    
    /*@method SetHeaderData
     @param Primer parametro nombre de la imagen.ext la imagen debe esta en la carpeta ..\tcpdf\images\
     *@param dimensión de la imagen width
     *@param Titulo del encabezado
     *@param Subtitulo del encabezado
     */
    
    $pdf->SetHeaderData('imbanaco.jpg', '40', utf8_encode($com->empresa(1)), 'Valle del Cauca
'.
utf8_encode($com->empresa(2)).'
Comprobante No. '.
$com->datos(12).'  Fecha '.$com->fecha_comprobante());
    
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    
    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    
    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    
    //set some language-dependent strings
    $pdf->setLanguageArray($l);
    
    
    // ---------------------------------------------------------
    // set font
    
    
    // add a page
    $pdf->AddPage();
    
    //$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);
    
    $pdf->SetFont('helvetica', 'BI', 7);
    
    // -----------------------------------------------------------------------------
    
    $datos[$j]=$com->datos(2)." ".$com->datos(3);
    
    $html='
     
    
    <br><br><br>
    <center>
    
    <table  border="1" align="center" bordercolor="#000000"   frame="box" rules="all" class="tabla">
    
    <tr>
    
        <td colspan="4"><div><table width="100%" border="0" align="center">
             <tr bgcolor="#F2F2F2">
              <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>IDENTIFICACION</strong></div></td>
              <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>APELLIDOS</strong></div></td>
                <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>NOMBRES</strong></div></td>
                <td style="border:1px solid black;"><div align="center" class="Estilo2"><strong>SUELDO BASICO</strong></div></td>
            </tr>
               <tr>
              <td>'.utf8_encode($com->datos(4)).'</td>
              <td>'.utf8_encode($com->datos(3)).'</td>
                 <td>'.utf8_encode($com->datos(2)).'</td>
                 <td>$ '.number_format($com->datos(6),0,",",".").'</td>
            </tr>
            <tr bgcolor="#F2F2F2" style="border:1px solid black; ">
              <td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>CARGO</strong></div></td>
              <td bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>AREA</strong></div></td>
                <td colspan="2" bgcolor="#F2F2F2" style="border:1px solid black;"><div align="center" class="Estilo2"><strong>CONTRATO</strong></div></td>
              </tr>
            <tr>
              <td>'.utf8_encode($com->datos(7)).'</td>
              <td>'.utf8_encode($com->area()).'</td>
                 <td colspan="2">'.utf8_encode($com->datos(8)).'</td>
              </tr>
            
          </table>
        </div></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#F2F2F2"><div align="center" class="Estilo2"><strong>DEVENGOS</strong></div></td>
        <td colspan="2" bgcolor="#F2F2F2"><div align="center" class="Estilo1">DEDUCCIONES</div></td>
      </tr>
      <tr>
        <td colspan="2"><table width="150%" border="0" class="tabla">
          <tr>
            <td width="210" class="Estilo2">Concepto</td>
            <td width="40" class="Estilo2">cantidad</td>
            <td width="60" class="Estilo2">valor</td>
          </tr>';
          
          $i=0;
          $sumar=0;
          while($i < count($generar)){
            if($generar[$i]["codcon1"]<> null && $generar[$i]["can1"] <> null && $generar[$i]["val1"]<> null){
          $sumar+=$generar[$i]["val1"];
          $html.='<tr>
            <td><div align="left">'.$generar[$i]["codcon1"].' &nbsp;&nbsp;'.utf8_encode($generar[$i]["nomcon1"]).'</div></td>
            <td>'.number_format($generar[$i]["can1"],2,".",".").'</td>
            <td>$ '.number_format($generar[$i]["val1"],0,",",".").'</td>
          </tr>';
            }
          $i++;
	        }
                $html.='
        </table></td>
        <td colspan="2"><table width="100%" border="0" class="tabla">
          <tr>
            <td width="210" class="Estilo2">Concepto</td>
            <td width="40" class="Estilo2">cantidad</td>
            <td width="60" class="Estilo2">valor</td>
          </tr>';
          
               $i=0;
              $sumar2=0;
          while($i < count($generar)){
            if($generar[$i]["codcon2"]<> null && $generar[$i]["nomcon2"] <> null && $generar[$i]["can2"]<> null && $generar[$i]["val2"]<> null){
           //$sumar2+=$generar[$i]["val2"];
     
          $html.='<tr>
            <td><div align="left">'.$generar[$i]["codcon2"].' &nbsp;&nbsp;'.utf8_encode($generar[$i]["nomcon2"]).'</div></td>
            <td>'.number_format($generar[$i]["can2"],2,".",".").'</td>
            <td>$ '.number_format($generar[$i]["val2"],0,",",".").'</td>
          </tr>';
      
            }
          $i++;
	        }
          $html.='
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#F2F2F2"><div align="center" class="Estilo2"><strong>TOTAL DEVENGOS</strong></div></td>
        <td><div align="center" class="tabla">$ '.number_format($com->neto_pagar(1),0,",",".").'</div></td>
        <td class="Estilo2" bgcolor="#F2F2F2" ><div align="center"><strong>TOTAL DEDUCCIONES</strong></div></td>
        <td><div align="center" class="tabla">$ '.number_format($com->neto_pagar(2),0,",",".").'</div></td>
      </tr>
      <tr>
        <td class="Estilo2" bgcolor="#F2F2F2" ><div align="center"><strong>PAGO</strong></div></td>
        <td><div align="center" class="tabla">'.utf8_encode($com->datos(9)).' '.utf8_encode($com->datos(10)).' #'.$com->datos(11).'</div></td>
        <td class="Estilo2" bgcolor="#F2F2F2"><div align="center"><strong>NETO A PAGAR</strong></div></td>
        <td><div align="center" class="tabla">$ '.number_format($com->neto_pagar(3),0,",",".").'</div></td>
      </tr>
      <tr>
        <td height="40" colspan="4">&nbsp;</td>
      </tr>
    </table>
    
    <p style="text-align:rigth">Talentos y Tecnolog&iacute;a S.A.S</p>
    
    </center>
    ';
    
    
    $pdf->writeHTML($html, true, false, false, false,'');
   
    if(isset($_POST["ver"])){
    
     $pdf->Output("Comprobante_pago_".$com->fecha_comprobante().".pdf", 'I');
	 
	 
	 
	 
    }else{
        

			
	   $content_PDF=$pdf->Output('', 'S');
    
		   //Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
       $mail->AddAddress(@$email); // Esta es la dirección a donde enviamos @$_SESSION['cor']
       $mail->IsHTML(true); // El correo se envía como HTML
       $mail->Subject = "Envio de Comprobante"; // Este es el titulo del email.
       $empleado=@$email;
       $body = "Señor(a) ".$email." su comprobante es:<br><br><br>";
       $mail->Body = "Se le hace entrega de su respectivo Comprobante de Pago."; // Mensaje a enviar
       $mail->AddStringAttachment($content_PDF,"comprobante.pdf"); //me permite enviar archivos adjuntos sin necesidad de indicar ruta 
       $exito = $mail->Send(); // Envía el correo.
       //También podríamos agregar simples verificaciones para saber si se envió:
        if($exito){
            echo '<script>alert("La solicitud fue procesada");window.close();</script>';
			//die();
			
			//window.close();
			
          }else{
            echo '<script>alert("Hubo un inconveniente. Contacta a un administrador."); window.close();</script>';
          }
			
			
	
	
		
	

	
	//$emailTemp = $email;
	
	//die("jjj");
	
	
            
    
  
	   
        
        

   

           }
        }
   }
   $si=implode('<br>&nbsp;&nbsp;&nbsp;-',$datos);

$datos2=explode("+",$si);

echo "Se enviaron: ".count($cedulas)." Correos";

}

?>