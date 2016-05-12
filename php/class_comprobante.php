<?php

require_once '../lib/connection.php';

class comprobante{
    
    private $lista;
    private $ano=0;
   
    private $liq_ini;
    private $per_ini;
    private $tip_pag;
    private $cod_emp;
    private $codigo;
    
   
    
    
    /*
     *@method neto_pagar genera el neto a pagar del empleado
     *@param $type indicamos que dato queremos mostrar
     *si es 1 mostramos total_devengos
     *si es 2 mostramos total_deducciones
     *si es 3 ostramos neto_apagar
     *
    */
    
        function neto_pagar($type){
	
	global $conn;
	
	$sql="select tot_dev,tot_ded, (tot_dev - tot_ded)as total
	     from totales_pago
	     where ano_ini='$this->ano' and liq_ini = '$this->liq_ini' 
	     and per_ini = $this->per_ini
	     and tip_pag = '$this->tip_pag'
	     and cod_emp = 1 
             and cod_epl='".$this->codigo."'";
	     
	      $array=null;
	
	$rs=$conn->Execute($sql);
	if($rs){
	$fila=@$rs->FetchRow();
	
	switch($type){
	  case 1:
	  $array=$fila["tot_dev"];
	  break;
	  case 2:
	  $array=$fila["tot_ded"];
	  break;
	 case 3:
	  $array=$fila["total"];
	  break;
	}
	
	}else{
	    
	    $array=null;
	}
	return $array;
	     
	     
    }
    



    
     /*@method consulta_de_empl me trae los empleados que cumpla con el filtro
     *que realiza la encargada/o de la nomina 
     */
    function consulta_de_empl(){
	
	  // se modifico la consulta para adicionar el correo electronico
	  // la original es:::
	  
	  // $sql="select a.cod_epl,a.cedula,a.nom_epl,a.ape_epl,c.nom_car,b.nom_CC2
	     // from empleados_basic a,CENTROCOSTO2 b,cargos c
	     // where a.cod_CC2 = b.cod_CC2 
         // and a.cod_car=c.cod_car
	     // and a.cod_epl 
         // in (select distinct cod_epl from totales_pago 
             // where ano_ini='$this->ano' and liq_ini = '$this->liq_ini' 
			 // and per_ini = $this->per_ini
			 // and tip_pag = '$this->tip_pag' 
             // and cod_emp = 1 ) and a.estado='A' order by nom_epl";
             
	
	
	 $sql="select d.email as EMAIL, a.cod_epl,a.cedula,a.nom_epl,a.ape_epl,c.nom_car,b.nom_CC2
	     from empleados_basic a,empleados_gral d,CENTROCOSTO2 b,cargos c
	     where a.cod_CC2 = b.cod_CC2 and d.cod_epl  = a.cod_epl
         and a.cod_car=c.cod_car
	     and a.cod_epl 
         in (select distinct cod_epl from totales_pago 
             where ano_ini='$this->ano' and liq_ini = '$this->liq_ini' 
			 and per_ini = $this->per_ini
			 and tip_pag = '$this->tip_pag' 
             and cod_emp = 1 ) and a.estado='A' order by nom_epl";
			 
	     
	     try{
		
		global $conn;//llamo la variable global para realiza un conexion a la nd
	        $array=array();//Creo un objeto el cual me captura los resultados de la sentencia
		
		$rs=$conn->Execute($sql);//ejecuto la sentencia sql
	
	        if($rs){//valido si $rs contiene datos 
	    
	        while($fila=@$rs->FetchRow()){
	    
	        $array[]=array("codigo"=>$fila["cod_epl"],
			   "nombre"=>$fila["nom_epl"],
			   "apellido"=>$fila["ape_epl"],
			   "cargo"=>$fila["nom_car"],
			   "area"=>$fila["nom_CC2"],
			   "cedula"=>$fila["cedula"],
			   "email"=>$fila["EMAIL"]);
	    
	       }
	       }else{
		$array=null;
		
	       }
	     }catch(exception $e){
		
		echo "Error: ".$e;
	     }

	return $array;
	
    }
    
    public function set_ano($ano){
	
	$this->ano=$ano;
    }
    public function set_liq_ini($liq_ini){
	
	$this->liq_ini=$liq_ini;
    }
    public function set_per_ini($per_ini){
	$this->per_ini=$per_ini;
    }
    public function set_tip_pag($tip_pag){
	$this->tip_pag=$tip_pag;
    }
    public function set_cod_emp($cod_emp){
	$this->cod_emp=$cod_emp;
    }
    public function set_codigo($codigo){
	$this->codigo=$codigo;
    }

    
    
	
	
    public function get_ano(){
	return $this->ano;
    }
    public function get_liq_ini(){
	return $this->liq_ini;
    }
    public function get_per_ini(){
	return $this->per_ini;
    }
    public function get_tip_pag(){
	return $this->tip_pag;
    }
    public function get_cod_emp(){
	return $this->cod_emp;
    }
    public function get_codigo(){
	return $this->codigo;
    }
  
 
    
   public function return_sql($codigo,$ano,$liqui,$per,$tip){
    
    
    $sql="SELECT h.cod_epl,h.ape_epl,h.nom_epl,h.cedula,h.nom_ban,h.num_cta,h.nom_sucur,h.consigna,h.numerocomp,
h.n_dia_ini,h.n_dia_fin,h.n_mes,h.codcon1,h.nomcon1,h.can1,h.val1,h.codcon2,h.nomcon2,h.can2,h.val2,
h.codemp,h.coddep,h.codcc2,h.nomcc2,h.nomcar,h.salbas,h.direpl,h.ubiepl,h.pagina,h.nomcc,h.campo1,
h.cnsctvo,h.ciu_tra,h.nom_ciu_tra,h.codcc,h.nomcc,h.codcar,h.campo5
FROM det_compro h
WHERE  h.codemp = 1  
and h.cod_epl = '".$codigo."'
and   numerocomp in (select num_com from totales_pago 
					where ano_ini = ".$ano." and liq_ini = '".$liqui."' 
					and per_ini = ".$per." 
					and tip_pag = '".$tip."' and cod_emp = 1 
					and totales_pago.cod_epl =  '".$codigo."'
					) order by nomcar desc";
					
					
	// $sql="select * from det_compro where cod_epl = '".$codigo."' and numerocomp in (select num_com from totales_pago 
					// where ano_ini = ".$ano." and liq_ini = '".$liqui."' 
					// and per_ini = ".$per." 
					// and tip_pag = '".$tip."' and cod_emp = 1 
					// and totales_pago.cod_epl =  '".$codigo."'
					// )	";			
					
					
 // var_dump($sql);
 
 return $sql;
 
   }
    function comprobante(){
        
        
          global $conn, $is_connect;
        

			 
		 $res=$conn->Execute($this->return_sql($this->codigo,$this->ano, $this->liq_ini,$this->per_ini,$this->tip_pag));
		 if($res){
			 $this->lista = array();
			while($row = @$res->FetchRow()){

				$this->lista[] = array("cod_epl"=>$row["cod_epl"],
							"ape_epl"=>utf8_encode($row["ape_epl"]),
							"nom_epl"=>utf8_encode($row["nom_epl"]),
                                                        "cedula"=>$row["cedula"],
                                                        "nom_ban"=>utf8_encode($row["nom_ban"]),
                                                        "num_cta"=>$row["num_cta"],
                                                        "nom_sucur"=>utf8_encode($row["nom_sucur"]),
                                                        "consigna"=>$row["consigna"],
                                                        "numerocomp"=>$row["numerocomp"],
                                                        "n_dia_ini"=>$row["n_dia_ini"],
                                                         "n_dia_fin"=>$row["n_dia_fin"],
                                                        "n_mes"=>$row["n_mes"],
                                                        "codcon1"=>$row["codcon1"],
                                                        "nomcon1"=>utf8_encode($row["nomcon1"]),
                                                         "can1"=>$row["can1"],
                                                        "val1"=>$row["val1"],
                                                        "codcon2"=>$row["codcon2"],
                                                        "nomcon2"=>$row["nomcon2"],
                                                        "can2"=>$row["can2"],                                                        
                                                        "val2"=>$row["val2"],
                                                        "codemp"=>$row["codemp"],
                                                        "coddep"=>$row["coddep"],                                                        
                                                        "codcc2"=>$row["codcc2"],                                                        
                                                        "nomcc2"=>$row["nomcc2"],                                                        
                                                        "nomcar"=>$row["nomcar"],                                                        
                                                        "salbas"=>$row["salbas"],                                                        
                                                        "direpl"=>$row["direpl"],                                                        
                                                        "ubiepl"=>$row["ubiepl"],
                                                        "pagina"=>$row["pagina"],
                                                        "nomcc"=>$row["nomcc"],                                                        
                                                        "campo1"=>$row["campo1"],                                                        
                                                        "nomcc"=>$row["nomcc"],                                                        
                                                        "cnsctvo"=>$row["cnsctvo"],                                                        
                                                        "ciu_tra"=>$row["ciu_tra"],
                                                        "nom_ciu_tra"=>$row["nom_ciu_tra"],                                                        
                                                        "codcc"=>$row["codcc"],
                                                        "nomcc"=>$row["nomcc"],
                                                        "codcar"=>$row["codcar"],
                                                        "campo5"=>$row["campo5"]);				
			}			
		 }
		else $this->lista = NULL;
		//$res->Close();
    }
	
   function get_lista(){
	   
	   return $this->lista;
   }
   
   function datos($type){
   
    global $conn, $is_connect;
    $array=null;
    
    $rs=$conn->Execute($this->return_sql($this->codigo,$this->ano, $this->liq_ini,$this->per_ini,$this->tip_pag));
    if($rs){
    $fila=@$rs->FetchRow();
    
    switch($type){
	case 1:
	    $array=$fila["cod_epl"];
	    break;
	case 2:
	    $array=$fila["nom_epl"];
	    break;
	case 3:
	    $array=$fila["ape_epl"];
	    break;
	case 4:
	    $array=$fila["cedula"];
	    break;
	case 5:
	    $array=$fila["nom_emp"];
	    break;
	case 6:
	    $array=$fila["salbas"];
	    break;
	case 7:
	    $array=$fila["nomcar"];
	    break;
	case 8:
	    $array=$fila["campo1"];
	    break;
	case 9:
	    $array=$fila["consigna"];
	    break;
	case 10:
	    $array=$fila["nom_ban"];
	    break;
	case 11:
	    $array=$fila["num_cta"];
	    break;
	case 12:
	    $array=$fila["numerocomp"];
	    break;

    }
    
    }else{
	
	$array=null;
    }
    return $array;
   }
   
   function area(){
    
    $sql="select a.cod_epl,a.estado,a.cod_dep,b.nom_CC2
         from empleados_basic a,CENTROCOSTO2 b
         where a.cod_CC2 = b.cod_CC2
         and a.cod_epl='".$this->codigo."' --Area empleado--";
	 
	 
	     global $conn, $is_connect;
    $array=null;
    
    $rs=$conn->Execute($sql);
    if($rs){
    $fila=@$rs->FetchRow();
    
      $array=$fila["nom_CC2"];
    
    }else{
	
	$array=null;
    }
    return $array;
         
	 
   }
   function empresa($type){
    
    
    $sql="SELECT emp.nom_emp,emp.email 
FROM empresas emp
WHERE emp.cod_emp=1";

  global $conn, $is_connect;
    $array=null;
    
    $rs=$conn->Execute($sql);
    if($rs){
    $fila=@$rs->FetchRow();
    
    switch($type){
      case 1:
      $array=$fila["nom_emp"];
      break;
      case 2:
      $array=$fila["email"];
      break;
    }
    
    }else{
	
	$array=null;
    }
    return $array;
   }
   
   
       function email_empleado($cedula){
	
	$sql="select email from empleados_gral g, empleados_basic b 
             where g.cod_epl=b.cod_epl and cedula='".$cedula."'";
    
         global $conn, $is_connect;
	 $array=null;
	
	$rs=$conn->Execute($sql);
	if($rs){
	$fila=@$rs->FetchRow();
	
	
	  $array=$fila["email"];
	
	
	}else{
	    
	    $array=null;
	}
	return $array;
	
    }
    
    /*funcion para saber la fecha que se genero el comprobante*/

function fecha_comprobante(){
	
	$sql="select top(1)(convert(varchar,b.fec_ini,103)+' - '+ convert(varchar,b.fec_fin,103)) as fecha 
         from totales_pago a 
         inner join periodos b on a.tip_pag=b.tip_per
         where b.ano='$this->ano'
             and b.cod_per='$this->per_ini'  
             and b.tip_per='$this->tip_pag' 
             and a.cod_epl = '$this->codigo'";


	      global $conn;
	      $array=null;
	      $rs=$conn->Execute($sql);
	      if($rs){
	$fila=@$rs->FetchRow();
	
	
	  $array=$fila["fecha"];
	
	
	}else{
	    
	    $array=null;
	}
	return $array;
    }
    
    
    





        
    
    
    
}

?>