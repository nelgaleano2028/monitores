<?php
@session_start();

/*
 *LLamamos al ADODB para realizar sentencias SQL de la BD
 */

require_once("../lib/connection.php");




class Catalogos{
    
    
    /*
     *@method llear_combo
     *@param $query->sentencia sql
     *@param $val->dato que representa el codigo del select
     *@param $str->datos que se imprime por pantalla
     *@param $is_item_default->TRUE o FALSE para mostrar en el select SELECCIONE
     */
    
    function llenar_combo($query,$val,$str,$is_item_default=true){	
		  
		  if($is_item_default)
		    $this->combo_item_defautl();//muestro el item por defecto que tendrá cada combo
		  global $conn, $is_connect;
		  if(!$is_connect){
			 $this->combo_item_empty();
			 return;
		 }
		 
		 $res=$conn->Execute($query);
		 if($res){
			 if($res->RecordCount() == 0){
				  $this->combo_item_empty();
			      return;
			 }
			 while($row = @$res->FetchRow()){
				  echo "<option value='".$row[$val]."'>".utf8_encode($row[$str])."</option>\n";
			 }			
		 }
		else $this->combo_item_empty();
		$res->Close();
    }
    
    function combo_item_empty(){//item vacio del combo box		
		echo "<option title='No hay valores registrados.' value='0'>(Ninguno)</option>";				 
    }
    
    function combo_item_defautl(){//item que se muestra por defecto
		echo"<option value='-1'>Seleccione</option>\n";
    }
    
    function prueba(){
	
	    $this->llenar_combo("select * from liquidacion order by nom_liq","cod_liq","nom_liq",true);
    }
    
    function meses(){
	     $this->llenar_combo("select * from tipos_periodo order by nom_tip" ,"tip_per","nom_tip",true);
    }
    function ano(){
	      
	      $this->llenar_combo("select CONVERT(int,ano_ini)AS ano_ini from totales_pago where cod_epl='".$_SESSION['cod']."' group by ano_ini","ano_ini","ano_ini",true);
    }
    function ano_epleados(){//muestra el historial de los años (comprobante de pago) de todos los empleados
	      
	      $this->llenar_combo("select convert(int,ano_ini) as ano_ini from totales_pago where  cod_emp = 1 group by ano_ini order by ano_ini","ano_ini","ano_ini",true);
    }
     function combo_mes(){
	      
	      $this->combo_item_defautl();
	      echo "<option value='1'>Enero</option>
	            <option value='2'>Febrero</option>
		    <option value='3'>Marzo</option>
		    <option value='4'>Abril</option>
		    <option value='5'>Mayo</option>
		    <option value='6'>Junio</option>
		    <option value='7'>Julio</option>
		    <option value='8'>Agosto</option>
		    <option value='9'>Septiembre</option>
		    <option value='10'>Octubre</option>
		    <option value='11'>Noviembre</option>
		    <option value='12'>Diciembre</option>";
    }
    function combo_mes_quin(){
	      $this->combo_item_defautl();
	      echo "<option value='1'>1 quincena de Enero</option>
	            <option value='2'>2 quincena de Enero</option>
		    <option value='3'>1 quincena de Febrero</option>
		    <option value='4'>2 quincena de Febrero</option>
		    <option value='5'>1 quincena de Marzo</option>
		    <option value='6'>2 quincena de Marzo</option>
		    <option value='7'>1 quincena de Abril</option>
		    <option value='8'>2 quincena de Abril</option>
		    <option value='9'>1 quincena de Mayo</option>
		    <option value='10'>2 quincena de Mayo</option>
		    <option value='11'>1 quincena de Junio</option>
		    <option value='12'>2 quincena de Junio</option>
		    <option value='13'>1 quincena de Julio</option>
		    <option value='14'>2 quincena de Julio</option>
		    <option value='15'>1 quincena de Agosto</option>
		    <option value='16'>2 quincena de Agosto</option>
		    <option value='17'>1 quincena de Septiembre</option>
		    <option value='18'>2 quincena de Septiembre</option>
		    <option value='19'>1 quincena de Octubre</option>
		    <option value='20'>2 quincena de Octubre</option>
		    <option value='21'>1 quincena de Nomviembre</option>
		    <option value='22'>2 quincena de Nomviembre</option>
		    <option value='23'>1 quincena de Diciembre</option>
		    <option value='24'>2 quincena de Diciembre</option>";
    }
    
    function imbanaco_tipopago(){
	
	 $this->combo_item_defautl();
	      echo "<option value='02'>Quincenal</option>";
	
	}
	
	/*--------------------------*
	 *Catalogos de editar perfil*
	 *--------------------------*
	 */
	function catalogo_barrios(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_bar as COD_BAR,nom_bar as NOM_BAR from barrios order by nom_bar","COD_BAR","NOM_BAR",true);
	  }
	  function catalogo_nivel_educativo(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_nie as COD_NIE, nom_nie AS NOM_NIE from nivel_ed ORDER BY nom_nie","COD_NIE","NOM_NIE",true);
	  }
	  function catalogo_estado_civil(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_civ as COD_CIV, est_civ as EST_CIV from estado_civil order by est_civ","COD_CIV","EST_CIV",true);
	  }
	   function catalogo_ciudad(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_ciu as COD_CIU, nom_ciu as NOM_CIU from ciudades order by nom_ciu ","COD_CIU","NOM_CIU",true);
	  }
	  function catalogo_parentesco(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select tip_pco as TIP_PCO,nom_pco as NOM_PCO from parentesco order by nom_pco","TIP_PCO","NOM_PCO",true);
	  }
	    function catalogo_estudios(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_est as COD_EST,nom_est as NOM_EST from estudios order by nom_est","COD_EST","NOM_EST",true);
	  }
	    function catalogo_titulos(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_ttp as COD_TTP,desc_ttp as DESC_TTP from titulos order by desc_ttp","COD_TTP","DESC_TTP",true);
	  }
	      function catalogo_unidades(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_uni as COD_UNI,nom_uni as NOM_UNI from unidades order by NOM_UNI","COD_UNI","NOM_UNI",true);
	  }
	   function catalogo_entidades(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_enti as COD_ENTI,nom_enti as NOM_ENTI from entid_cp order by nom_enti","COD_ENTI","NOM_ENTI",true);
	  }
	   function catalogo_paises(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_pai as COD_PAI, nom_pai as NOM_PAI from paises order by nom_pai","COD_PAI","NOM_PAI",true);
	  }
	  function catalogo_capacitacion(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_tca as COD_TCA,desc_tca as DESC_TCA from tipo_capac ORDER BY desc_tca","COD_TCA","DESC_TCA",true);
	  }
	   function catalogo_programacion_capa(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      //$this->llenar_combo("select cod_prc AS COD_PRC,desc_prc AS DESC_PRC from progs_cap ORDER BY desc_prc","COD_PRC","DESC_PRC",true);
	      $this->llenar_combo("select cod_prg as COD_PRC, desc_prg as DESC_PRC from progs_cap  order by desc_prg","COD_PRC","DESC_PRC",true);
	  }
	  function catalogo_areas(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_area AS COD_AREA,desc_area AS DESC_AREA from areas_co ORDER  BY desc_area","COD_AREA","DESC_AREA",true);
	  }
	    function catalogo_curso(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select cod_mdc AS COD_MDC,desc_mdc AS DESC_MDC from modal_curso ORDER BY desc_mdc","COD_MDC","DESC_MDC",true);
	  }
	  
	    function catalogo_tipo_documento(){//muestra todos los conceptos de la tabla novedades
	        global $conn,$odbc;

	      $this->llenar_combo("select tip_doc as TIP_DOC from parientes  group by tip_doc","TIP_DOC","TIP_DOC",true);
	  }
	  
	  
    
}


?>