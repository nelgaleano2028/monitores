<?php
//@session_start();
require_once('../lib/configdb.php');
require_once('../pjmail/pjmail.class.php'); 



require_once('../html2pdf/html2pdf.class.php');

cartalaboral();



function cartalaboral(){ 

global $conn;


if($_POST["cedula"]==null){
?> <script> alert("Ingresa una Cedula");
					close();</script> <?php 

}

if($_POST["cedula"]){




	$sql="select cod_epl from empleados_basic where cod_epl='".$_POST["cedula"]."'";
		
	  
			 
		 	$res=$conn->Execute($sql);


$row23 = $res->fetchrow();
			
$cedula=$row23["cod_epl"];


		 
		 	if(!$cedula){


			 
				?> <script> alert("Cedula Incorrecta");
					close();</script> <?php 				
				}
				




}


$codigo=$_POST["cedula"];



//Funcion convertir numeros a leras
function numtoletras($xcifra)
{ 
$xarray = array(0 => "Cero",
1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE", 
"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE", 
"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA", 
100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
);
//
$xcifra = trim($xcifra);
$xlength = strlen($xcifra);
$xpos_punto = strpos($xcifra, ".");
$xaux_int = $xcifra;
$xdecimales = "00";
if (!($xpos_punto === false))
   {
   if ($xpos_punto == 0)
      {
      $xcifra = "0".$xcifra;
      $xpos_punto = strpos($xcifra, ".");
      }
   $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
   $xdecimales = substr($xcifra."00", $xpos_punto + 1, 2); // obtengo los valores decimales
   }

$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
$xcadena = "";
for($xz = 0; $xz < 3; $xz++)
   {
   $xaux = substr($XAUX, $xz * 6, 6);
   $xi = 0; $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
   $xexit = true; // bandera para controlar el ciclo del While 
   while ($xexit)
      {
      if ($xi == $xlimite) // si ya llegó al límite máximo de enteros
         {
         break; // termina el ciclo
         }
   
      $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
      $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
      for ($xy = 1; $xy < 4; $xy++) // ciclo para revisar centenas, decenas y unidades, en ese orden
         {
         switch ($xy) 
            {
            case 1: // checa las centenas
               if (substr($xaux, 0, 3) < 100) // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                  {
                  }
               else
                  {
                  @$xseek = $xarray[substr($xaux, 0, 3)]; // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                  if ($xseek)
                     {
                     $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                     if (substr($xaux, 0, 3) == 100) 
                        $xcadena = " ".$xcadena." CIEN ".$xsub;
                     else
                        $xcadena = " ".$xcadena." ".$xseek." ".$xsub;
                     $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                     }
                  else // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                     {
                     $xseek = $xarray[substr($xaux, 0, 1) * 100]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                     $xcadena = " ".$xcadena." ".$xseek;
                     } // ENDIF ($xseek)
                  } // ENDIF (substr($xaux, 0, 3) < 100)
               break;
            case 2: // checa las decenas (con la misma lógica que las centenas)
               if (substr($xaux, 1, 2) < 10)
                  {
                  }
               else
                  {
                  @$xseek = $xarray[substr($xaux, 1, 2)];
                  if ($xseek)
                     {
                     $xsub = subfijo($xaux);
                     if (substr($xaux, 1, 2) == 20)
                        $xcadena = " ".$xcadena." VEINTE ".$xsub;
                     else
                        $xcadena = " ".$xcadena." ".$xseek." ".$xsub;
                     $xy = 3;
                     }
                  else
                     {
                     $xseek = $xarray[substr($xaux, 1, 1) * 10];
                     if (substr($xaux, 1, 1) * 10 == 20)
                        $xcadena = " ".$xcadena." ".$xseek;
                     else  
                        $xcadena = " ".$xcadena." ".$xseek." Y ";
                     } // ENDIF ($xseek)
                  } // ENDIF (substr($xaux, 1, 2) < 10)
               break;
            case 3: // checa las unidades
               if (substr($xaux, 2, 1) < 1) // si la unidad es cero, ya no hace nada
                  {
                  }
               else
                  {
                  $xseek = $xarray[substr($xaux, 2, 1)]; // obtengo directamente el valor de la unidad (del uno al nueve)
                  $xsub = subfijo($xaux);
                  $xcadena = " ".$xcadena." ".$xseek." ".$xsub;
                  } // ENDIF (substr($xaux, 2, 1) < 1)
               break;
            } // END SWITCH
         } // END FOR
         $xi = $xi + 3;
      } // ENDDO

      if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
         $xcadena.= " DE";
         
      if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
         $xcadena.= " DE";
      
      // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
      if (trim($xaux) != "")
         {
         switch ($xz)
            {
            case 0:
               if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                  $xcadena.= "UN BILLON ";
               else
                  $xcadena.= " BILLONES ";
               break;
            case 1:
               if (trim(substr($XAUX, $xz * 6, 6)) == "1")
                  $xcadena.= "UN MILLON ";
               else
                  $xcadena.= " MILLONES ";
               break;
            case 2:
               if ($xcifra < 1 )
                  {
                  $xcadena = "CERO PESOS ";
                  }
               if ($xcifra >= 1 && $xcifra < 2)
                  {
                  $xcadena = "UN PESO ";
                  }
               if ($xcifra >= 2)
                  {
                  $xcadena.= " PESOS m/cte "; // 
                  }
               break;
            } // endswitch ($xz)
         } // ENDIF (trim($xaux) != "")
      // ------------------      en este caso, para México se usa esta leyenda     ----------------
      $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
      $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
      $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
      $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
      $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
      $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
      $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
   } // ENDFOR ($xz)
   return trim($xcadena);
} // END FUNCTION


function subfijo($xx)
   { // esta función regresa un subfijo para la cifra
   $xx = trim($xx);
   $xstrlen = strlen($xx);
   if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
      $xsub = "";
   // 
   if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
      $xsub = "MIL";
   //
   return $xsub;
   } // END FUNCTION


function mes($num){
    /**
     * Creamos un array con los meses disponibles.
     * Agregamos un valor cualquiera al comienzo del array para que los números coincidan
     * con el valor tradicional del mes. El valor "Error" resultará útil
     **/
    $meses = array('Error', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
 
    /**
     * Si el número ingresado está entre 1 y 12 asignar la parte entera.
     * De lo contrario asignar "0"
     **/
    $num_limpio = $num >= 1 && $num <= 12 ? intval($num) : 0;
    return $meses[$num_limpio];
}


function fechaATexto($fecha, $formato = 'c') {
 
    // Validamos que la cadena satisfaga el formato deseado y almacenamos las partes
    if (@ereg("([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})", $fecha, $partes)) {
        // $partes[0] contiene la cadena original
        // $partes[1] contiene el año
        // $partes[2] contiene el número de mes
        // $partes[3] contiene el número del día
        $mes = ' de ' . mes($partes[2]) . ' de '; // Corregido!
        if ($formato == 'u') {
            $mes = strtoupper($mes);
        } elseif ($formato == 'l') {
            $mes = strtolower($mes);
        }
        return $partes[3] . $mes . $partes[1];
 
    } else {
        // Si hubo problemas en la validación, devolvemos false
        return false;
    }
}
 


//Esto es para el parrafo que dice para constancia de
$diaactual=date ("d");
$mesactual=date ("n");
$anoactual=date ("Y");

$meses = array("Enero", "Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$nombre_mes = $meses[$mesactual-1];




//Query que retorna la informacion de la empresa

$qry1="SELECT emp.fax, emp.nom_emp,emp.dir_emp,emp.nit_emp,emp.digito_ver,ciu.cod_ciu_iss,ciu.cod_dpt,ciu.nom_ciu,depa.nom_dpt,tel_1 
FROM empresas emp,ciudades ciu,dpto_pais depa 
--INTO :str_nom_emp,:str_dir_emp,:str_nit,:str_digito_ver,:str_cod_ciu,:str_cod_dpt,:str_ciu,:str_depar,:str_tel_emp
WHERE emp.cod_ciu=ciu.cod_ciu AND ciu.cod_dpt=depa.cod_dpt AND emp.cod_emp='1'";

$rh1 = $conn->Execute($qry1); 

$row1 = $rh1->FetchRow();

$nombre_empresa=utf8_encode($row1["nom_emp"]);
$nit_empresa=$row1["nit_emp"];
$nom_ciudad=$row1["nom_ciu"];
$cod_departamento=$row1["cod_dpt"];
$direccion=$row1["dir_emp"];
$fax=$row1["fax"];
$telefono=$row1["tel_1"];



//Fecha actual del sistema para certificado Laboral
$fecha_actual=date("d/m/Y");




//Datos del Empleado
$qry2="select *,convert(varchar(20),ini_cto,111) as ini_cto, convert(varchar(20),fec_ret,101) as fec_ret from empleados_basic a, cargos b where a.cod_car=b.cod_car and a.cod_epl='".$codigo."'";

 				  
$rh2 = $conn->Execute($qry2); 

$row2 = $rh2->FetchRow();


$nombre=$row2["nom_epl"];
$apellido=$row2["ape_epl"];
$cedula=$row2["cedula"];

$fecha=$row2["ini_cto"];
$fecha_real=fechaATexto($fecha);

$fecha_retiro=$row2["fec_ret"];
$sueldo=$row2["sal_bas"];
$cargo=$row2["nom_car"];

$letrasnum=numtoletras($sueldo);



//Saca la cuidad de expedicion de la cedula
$qrybonus="select nom_ciu from empleados_basic a, ciudades b where cod_epl='".$codigo."' and a.ciu_exp=b.cod_ciu";
				  
$rhbonus = $conn->Execute($qrybonus); 

$rowbonus = $rhbonus->FetchRow();

$nombre_ciudad_cc=$rowbonus["nom_ciu"];




//FIRMA DEL CERTIFICADO LABORAL
$qry3="select * from certi_parfir c, empleados_basic e where e.cod_epl=c.cod_epl";

				  
$rh3 = $conn->Execute($qry3); 

$row3 = $rh3->FetchRow();


$nombrefirma=$row3["nom_epl"];
$apellidofirma=$row3["ape_epl"];
$cargofirma=$row3["DESC_CARGO"];





//Datos del contrato del empleado
$qryold="select e.cod_epl, e.cod_cto, c.nom_cto from contratos c, empleados_basic e where e.cod_cto=c.cod_cto and cod_epl='".$codigo."'";

$rhold = $conn->Execute($qryold); 

$rowold = $rhold->FetchRow();

$contrato=$rowold["nom_cto"];





/////////////SALARIO PROMEDIO

//Inicialmente saco el campo fec_ult_nom de empleados basic
$qry0_1="select convert(varchar(20),fec_ult_nom,105) as fec_ult_nom from empleados_basic where cod_epl='".$codigo."'";

			
				  
$rh0_1 = $conn->Execute($qry0_1); 

$row0_1 = $rh0_1->FetchRow();


$fecha_ultima=$row0_1["fec_ult_nom"];

//var_dump($fecha_ultima);die("");
//15-01-2013




//Realizo un select de la tabla periodos para luego comparar esa $fecha_ultima con una de la tabla periodos en fec_fin y cojo ese cod_per
$qry0_2="select cod_per, convert(varchar(20),fec_fin,105) as fec_fin from periodos";


$rh0_2 = $conn->Execute($qry0_2); 


while($row0_2 = $rh0_2->FetchRow()){

if($fecha_ultima==$row0_2["fec_fin"]){
	
	
	$codigo_periodo=$row0_2["cod_per"];
	//$codigo_per_final=$codigo_periodo-1;
	//var_dump($codigo_periodo);die("");
	//1
}
	
}



//condicion para identificar dias 30 y 15
$dia=substr($fecha_ultima, 0, 2);

//var_dump($dia);die("");


//dias para dividirlo
$mes=substr($fecha_ultima, 3, 2);



if($dia=="15"){


$t_dias=30*$mes-15;

//var_dump($t_dias);die("");



}else{


$t_dias=30*$mes;

//var_dump($t_dias);die("");
}


//Super query que me da el valor para hacer la gestion del promedio
$qry0="select sum(h.valor) as valor
from historia_liq h
where h.cod_epl = '".$codigo."'
and h.cod_con in (select cg.cod_con_base
                                       from conceptos_grupo cg,epl_grupos e
                                       where cg.cod_gru=e.cod_gru and e.cod_epl=h.cod_epl
                                       and cg.cod_liq = 01 and  cg.cod_con = 18 AND cg.pro_sn = 'S' )
                                and h.ano = 2013
                                and h.cod_per between 1 and '".$codigo_periodo."'";

			  
$rh0 = $conn->Execute($qry0); 

$row0 = $rh0->FetchRow();


$valor=$row0["valor"]; 


$prom_ano = ($valor*30) / $t_dias;


$letrasnum1=numtoletras($prom_ano);
///////FIN SALARIO PROMEDIO







/////////COMPENSACION FLEXIBLE
$qrycer1="select porcentaje  from com_flexible_c where cod_epl = '".$codigo."' and estado='A'";

				  
$rhcer1 = $conn->Execute($qrycer1); 

$rowcer1 = $rhcer1->FetchRow();


$porcentaje=$rowcer1["porcentaje"];

//var_dump($porcentaje);die("");

if($porcentaje){


	//var_dump($codigo_periodo);die("");

	$qry_comodin="select h.cod_con, c.nom_con, sum(h.valor) as valor_cf 
	from historia_liq h, conceptos c
	where h.cod_epl = '".$codigo."'  and
	(h.cod_con in (select cod_con from com_flexible where cod_epl='".$codigo."')
	or h.cod_con in (SELECT COD_CON FROM CONCEPTOS WHERE COD_CON >=200 AND COD_CON<= 299))
	and h.cod_con not in(225) 
	and h.ano =2013 and c.cod_con = h.cod_con 
	and h.cod_per between 1 and '".$codigo_periodo."' 
	group by h.cod_con, c.nom_con ";


			  
	$rh0_c = $conn->Execute($qry_comodin); 

	
	$valor_cf=0;

	while($row0_c = $rh0_c->FetchRow()){

	$valor_cf=$valor_cf+$row0_c["valor_cf"];

	}

	
	//var_dump($valor_cf);die("");



	
	$qry_como="select h.cod_con, c.nom_con, sum(h.valor)as valor_como 
	from historia_liq h, conceptos c
	where h.cod_epl = '".$codigo."' and h.cod_con in (select cg.cod_con_base
                                       from conceptos_grupo cg,epl_grupos e
                                       where cg.cod_gru=e.cod_gru and e.cod_epl=h.cod_epl
                                       and cg.cod_liq = 01 and  cg.cod_con = 18 AND cg.pro_sn = 'S' )
	and h.cod_con not in(225) 
	and h.ano =2013 and c.cod_con = h.cod_con 
	and h.cod_per between 1 and '".$codigo_periodo."' 
	group by h.cod_con, c.nom_con";

	
		  
	$rh0_como = $conn->Execute($qry_como); 

	
	$valor_como=0;

	while($row0_como = $rh0_como->FetchRow()){

	$valor_como=$valor_como+$row0_como["valor_como"];

	}

	
	//var_dump($valor_como);die("");

	$total=$valor_como + $valor_cf;


	//var_dump($total);die("");

	
	//var_dump($mes);die("");

	$prom_flexible=$total/$mes;

	$letrasnum4=numtoletras($prom_flexible);


}



//Me genera el valor real del ingreso mensual con la compensacion flexible
$comp_flexi = $sueldo/(1-($porcentaje/100));

//var_dump($comp_flexi);die("");

$letrasnum3=numtoletras($comp_flexi);
//////////FIN COMPENSACION FLEXIBLE





if(@$_POST["salario"]=="sin_salario"){
$content = '<page  backleft="12mm" backright="12mm" backimg="../imagenes/membrete.jpg" backimgx="center" backimgy="top" backimgw="100%">

                <table border="0" >
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
			<tr>
                        <td><br></td>
                    </tr>
		    <tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:20px; text-align:center">CERTIFICADO LABORAL</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
			
                    <tr>
                        <td style="font-size:17px; text-align:justify">Certifico que el(la) se&ntilde;or(a) <span>'.$nombre.'</span> <span>'.$apellido.'</span> identificado(a) con c&eacute;dula de ciudadan&iacute;a n&uacute;mero <span>'.$cedula.'</span> de <span>'.$nombre_ciudad_cc.'</span>, labora en '.$nombre_empresa.' desde el d&iacute;a <span>'.$fecha_real.'</span>.</td>
 		
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td style="font-size:17px; text-align:justify">Contrato de Trabajo: <span>'.$contrato.'</span></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="font-size:17px; text-align:justify">Cargo: <span>'.$cargo.'</span></td>
                    </tr>
			<tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td style="font-size:17px; text-align:justify">Para constancia se expide este certificado en la ciudad de CALI, a los <span>'.$diaactual.'</span> d&iacute;as del mes de <span>'.$nombre_mes.'</span> de <span>'.$anoactual.'</span></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
					<tr>
                        <td><br></td>
                    </tr>
					 <tr>
                        <td><br></td>
                    </tr>
				
                    <tr>
                        <td style="font-size:17px; text-align:justify">NOTA: ESTE CERTIFICADO NO ES VALIDO SI PRESENTA ENMENDADURAS. SE TRATA DE UN DOCUMENTO ELECTR&Oacute;NICO POR LO QUE DEBE SER VALIDADA SU AUTENTICIDAD CON LA EMPRESA.</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
					<tr>
                        <td><span><IMG SRC="../imagenes/firmima.jpg" width="250" height="100"></span></td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold; font-size:17px; text-align:justify"><span>'.$nombrefirma.'</span> <span>'.$apellidofirma.'</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:17px; text-align:justify"><span>'.$cargofirma.'</span></td>
                    </tr>
                    
                    
       	
		</table>	
			
	    <page_footer></page_footer> </page> 
			';
}else if(@$_POST["salario"]=="sueldo_basico"){
	
	$content = '<page  backleft="12mm" backright="12mm" backimg="../imagenes/membrete.jpg" backimgx="center" backimgy="top" backimgw="100%">

                <table border="0" >
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
			<tr>
                        <td><br></td>
                    </tr>
		    <tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:20px; text-align:center">CERTIFICADO LABORAL</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="font-size:17px; text-align:justify">Certifico que el(la) se&ntilde;or(a) <span>'.$nombre.'</span> <span>'.$apellido.'</span> identificado(a) con c&eacute;dula de ciudadan&iacute;a n&uacute;mero <span>'.$cedula.'</span> de <span>'.$nombre_ciudad_cc.'</span>, labora en '.$nombre_empresa.' desde el d&iacute;a <span>'.$fecha_real.'</span>.</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td style="font-size:17px; text-align:justify">Contrato de Trabajo: <span>'.$contrato.'</span></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td style="font-size:17px; text-align:justify">Cargo: <span>'.$cargo.'</span></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td style="font-size:17px; text-align:justify">Sueldo b&aacute;sico mensual: <span>'.$letrasnum.'</span> ($<span>'.number_format($sueldo, 0, ",", ".").'</span>) </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
					 
					<tr>
                        <td style="font-size:17px; text-align:justify">Para constancia se expide este certificado en la ciudad de CALI, a los <span>'.$diaactual.'</span> d&iacute;as del mes de <span>'.$nombre_mes.'</span> de <span>'.$anoactual.'</span></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
					<tr>
                        <td><br></td>
                    </tr>
					 <tr>
                        <td><br></td>
                    </tr>
				
                    <tr>
                        <td style="font-size:17px; text-align:justify">NOTA: ESTE CERTIFICADO NO ES VALIDO SI PRESENTA ENMENDADURAS. SE TRATA DE UN DOCUMENTO ELECTR&Oacute;NICO POR LO QUE DEBE SER VALIDADA SU AUTENTICIDAD CON LA EMPRESA.</td>
                    </tr>
                  <tr>
                        <td><br></td>
                    </tr>
                   
					<tr>
                        <td><span><IMG SRC="../imagenes/firmima.jpg" width="250" height="100"></span></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:17px; text-align:justify"><span>'.$nombrefirma.'</span> <span>'.$apellidofirma.'</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:17px; text-align:justify"><span>'.$cargofirma.'</span></td>
                    </tr>
                    
             
			
		</table>	
			
	    <page_footer></page_footer> </page> 
			';


}else if(@$_POST["salario"]=="salario_prom"){

	
	$content = '<page  backleft="12mm" backright="12mm" backimg="../imagenes/membrete.jpg" backimgx="center" backimgy="top" backimgw="100%">

                <table border="0" >
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
			<tr>
                        <td><br></td>
                    </tr>
		    <tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
<tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:20px; text-align:center">CERTIFICADO LABORAL</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="font-size:17px; text-align:justify">Certifico que el(la) se&ntilde;or(a) <span>'.$nombre.'</span> <span>'.$apellido.'</span> identificado(a) con c&eacute;dula de ciudadan&iacute;a n&uacute;mero <span>'.$cedula.'</span> de <span>'.$nombre_ciudad_cc.'</span>, labora en '.$nombre_empresa.' desde el d&iacute;a <span>'.$fecha_real.'</span>.</td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td style="font-size:17px; text-align:justify">Contrato de Trabajo: <span>'.$contrato.'</span></td>
                    </tr>

                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td style="font-size:17px; text-align:justify">Cargo: <span>'.$cargo.'</span></td>
                    </tr>

                    <tr>
                        <td><br></td>
                    </tr>';
					
					if($porcentaje==NULL){
					
				  $content.='<tr>
                        <td style="font-size:17px; text-align:justify">Sueldo b&aacute;sico mensual: <span>'.$letrasnum.'</span> ($<span>'.number_format($sueldo, 0, ",", ".").'</span>) </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td style="font-size:17px; text-align:justify">Salario Promedio: <span>'.$letrasnum1.'</span> ($<span>'.number_format($prom_ano, 0, ",", ".").'</span>) </td>
                    </tr>					
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                    ';
	
					}else{
					
                 $content.='<tr>
                        <td style="font-size:17px; text-align:justify">Ingreso b&aacute;sico mensual: <span>'.$letrasnum3.'</span> ($<span>'.number_format($comp_flexi, 0, ",", ".").'</span>) </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>

                    <tr>
                        <td style="font-size:17px; text-align:justify">Ingreso Promedio, por concepto de tiempo extra, recargos nocturnos, dominicales, y/o festivos de: <span>'.$letrasnum4.'</span> ($<span>'.number_format($prom_flexible, 0, ",", ".").'</span>) </td>
                    </tr>					
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        ';
					}
					
					
                 $content.='<tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
					<td style="font-size:17px; text-align:justify">Para constancia se expide este certificado en la ciudad de CALI, a los <span>'.$diaactual.'</span> dias del mes de <span>'.$nombre_mes.'</span> de <span>'.$anoactual.'</span></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
					<tr>
                        <td><br></td>
                    </tr>
					
				
                    <tr>
                        <td style="font-size:17px; text-align:justify">NOTA: ESTE CERTIFICADO NO ES VALIDO SI PRESENTA ENMENDADURAS. SE TRATA DE UN DOCUMENTO ELECTR&Oacute;NICO POR LO QUE DEBE SER VALIDADA SU AUTENTICIDAD CON LA EMPRESA.</td>
                    </tr>
                 
         
					<tr>
                        <td><span><IMG SRC="../imagenes/firmima.jpg" width="250" height="100"></span></td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold; font-size:17px; text-align:justify"><span>'.$nombrefirma.'</span> <span>'.$apellidofirma.'</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold; font-size:17px; text-align:justify"><span>'.$cargofirma.'</span></td>
                    </tr>
                    
		
		</table>	
			
	    <page_footer></page_footer> </page> 
			';


}else{ ?> <script> alert("Elige una Opcion Valida en el Menu Certificado Laboral");
					close();</script> <?php   }






    
	
    	$html2pdf = new HTML2PDF('P','LETTER','en');
    	$html2pdf->WriteHTML(@$content);
	$html2pdf->Output('Certificado_Laboral.pdf', 'I');

			
		
	
 	
	
	
	
	
	}


	
?>
