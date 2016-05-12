<?php
require_once '../lib/configdb.php';


/*
En esta clase se encuentran todas las sentencias sql para mostrarlas en la hoja de vida del empleado
*/
class class_hoja{
	
	
	private $cod_empleado;
	
	private $lista=array();
	private $lista1=array();
	private $lista2=array();
	private $lista3=array();
	private $lista4=array();
	private $lista5=array();
	private $lista6=array();
	private $lista7=array();
	private $lista8=array();
	private $lista9=array();
	private $lista10=array();
	private $lista11=array();
	private $lista12=array();
	private $lista13=array();
	private $lista15=array();
	private $lista16;
	private $lista17=array();
	
	
	public function __construct($cod_empleado){
		$this->cod_empleado=$cod_empleado;
	}
	
	
	 public function set_num_comp($num_com){
       
       $this->num_com=$num_com;
   }
   
	public function get_num_comp(){
       
       return $this->num_com;
   }
	
	
	
	//Comprobantes de Pagp
	public function ultimos_comprobantes(){
     
     try{
         //variable global de conexion
         global $conn;
         
         //Sentencia sql 5 ultimos comprobantes
         $sql="select top(5) convert(int,num_com)as num_com,
               b.nom_liq,convert(int,per_ini)as per_ini,
               convert(int,ano_ini)as ano_ini ,
               convert(varchar,c.fec_fin,103)as fecha
               from totales_pago a,liquidacion b, periodos c
               where b.cod_liq=a.liq_ini  and a.tip_pag=c.tip_per
               and a.per_ini=c.cod_per and a.ano_ini=c.ano and a.cod_epl='".$this->cod_empleado."'
               ORDER BY ano_ini desc, per_ini desc";
         
                 
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
         //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista1[]=array("numero"=>$fila["num_com"],
                                      "liquidacion"=>utf8_encode($fila["nom_liq"]),
                                      "periodo"=>$fila["per_ini"],
                                      "ano"=>$fila["ano_ini"],
                                      "fecha"=>$fila["fecha"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista1=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista1;
     
    }
	
	
		
	//Prestamos
	public function prestamos(){
		
		global $conn;
		
		$sql="select num_cuo,fec_rad,vlr_tot,sdo_con,est_cuo
			  from cuotas  where cod_epl='".$this->cod_empleado."' order by fec_rad asc";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista2[] =  array("numero"=>$row["num_cuo"],
											"fecha_rad"=>$row["fec_rad"],
											"valor"=>$row["vlr_tot"],
                                        	"saldo"=>$row["sdo_con"],
                                        	"estado"=>$row["est_cuo"]);				
				}
			
					
		 	
			}else {
				$this->lista2 = NULL;
			}
			
			return $this->lista2;	
	}
	
	
	
	
	//Embargos
	public function embargos(){
		
		global $conn;
		
		$sql="select num_emb,fec_fin_emb,valor,saldo from 
			  embargos where cod_epl='".$this->cod_empleado."' order by fec_fin_emb desc";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista3[] =  array("numero"=>$row["num_emb"],
								 "fecha_fin_emb"=>$row["fec_fin_emb"],
								 "valor"=>$row["valor"],
								 "saldo"=>$row["saldo"]);				
			}
			
					
		 	
			}else {
				$this->lista3 = NULL;
			}	
		
     		return $this->lista3;	
	}
	
	
	
	
	//Historico de Liquidaciones
	public function historia_liq(){
		
		global $conn;
		
		$sql="select *, convert(varchar,fec_proceso,103)as fec_proceso from historia_liq where cod_epl='".$this->cod_empleado."'";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista4[] =  array("fecha_pro"=>$row["fec_proceso"],
											"valor"=>$row["valor"],
											"cantidad"=>$row["cantidad"],
                                        	"sueldo"=>$row["sal_bas"]);				
				}
			
					
		 	
			}else {
				$this->lista4 = NULL;
			}	
			
			return $this->lista4;	
	}
	
	
	
	
	public function formas_pago(){
		
		global $conn;
		
		$sql="select a.por_efe,a.por_che,a.por_cons,b.num_cta,c.nom_ban 
				from formas_pago a,epl_consigna b,bancos c 
				where a.cod_epl=b.cod_epl 
				and b.cod_ban=c.cod_ban 
				and a.cod_epl='".$this->cod_empleado."'
				and b.estado='A'";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista5[] =  array("efectivo"=>$row["por_efe"],
											"cheque"=>$row["por_che"],
											"consignar"=>$row["por_cons"],
											"cuenta"=>$row["num_cta"],
                                        	"banco"=>$row["nom_ban"]);				
				}
			
					
		 	
			}else {
				$this->lista5 = NULL;
			}	
		
			return $this->lista5;	
	}
	
	
	
	
	
	public function certificado(){
		
		global $conn;
		
		$sql="select *, convert(varchar,fecha,103)as fecha from certificados where cod_epl='".$this->cod_empleado."'";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista6[] =  array("valor"=>$row["valor"],
											"meses"=>$row["meses"],
											"valor_men"=>$row["vlr_men"],
											"fecha"=>$row["fecha"]);				
				}
			
					
		 	
			}else {
				$this->lista6 = NULL;
			}	
		
			return $this->lista6;	
	}
	
	
	
	
	
	public function aumentos(){
		
		global $conn;
		
		//52822413
		$sql="select valor_ant AS VALOR_ANT,valor_act as VALOR_ACT,dias_ret AS DIAS_RET,porcentaje AS PORCENTAJE, valor AS VALOR from aumentos where cod_epl='".$this->cod_empleado."'";
			  
			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista7[] =  array("anterior"=>$row["VALOR_ANT"],
											"actual"=>$row["VALOR_ACT"],
											"dias"=>$row["DIAS_RET"],
											"porcentaje"=>$row["PORCENTAJE"],
											"valor"=>$row["VALOR"]);				
				}
			
					
		 	
			}else {
				$this->lista7 = NULL;
			}	
		
			return $this->lista7;	
	}
	
	
	
	
	
	public function cesantias(){
		
		global $conn;
		
		/*OJO ESTA SENTENCIA ESTA BIEN SINO QUE NO ME MUSTRA LOS DATOS NULOS  VACIOS MIENTRAS QUE LA OTRA ES MAS COMPLETA
		$sql="select c.pro_ces,c.num_dia,c.valor,c.interes, c.pagar_a, c.tip_pag, f.nombre, 
			  convert(varchar(20),c.fecha,103) as fecha, convert(varchar(20),c.fec_pag_ant,103) as fec_pag_ant, 
			  convert(varchar(20),c.fec_pag_int,103) as fec_pag_int 
			  from cesantias c, fondos f 
			  where c.cod_fon=f.cod_fon and cod_epl='".$this->cod_empleado."' 
			  order by fecha DESC";
		*/	  
		$sql="SELECT c.valor,c.interes, c.tip_pag, f.nombre, 
			  convert(varchar(20),c.fecha,111) as fecha, convert(varchar(20),c.fec_pag_ant,111) as fec_pag_ant, 
			  convert(varchar(20),c.fec_pag_int,111) as fec_pag_int 
			  FROM cesantias c LEFT JOIN fondos f ON f.cod_fon=c.cod_fon 
			  where cod_epl='".$this->cod_empleado."' order by fecha desc";
						 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista8[] =  array("fecha"=>$row["fecha"],
											"nombre"=>$row["nombre"],
											"valor"=>$row["valor"],
											"tip_pag"=>$row["tip_pag"],
											"interes"=>$row["interes"],
											"fecha_pago"=>$row["fec_pag_ant"],
											"fecha_pago_interes"=>$row["fec_pag_int"]);				
				}
			
					
		 	
			}else {
				$this->lista8 = NULL;
			}	
		
			return $this->lista8;	
	}
	
	
	
	
	
	public function familiares(){
		
		global $conn;
		
		//66830581
		$sql="select *, convert(varchar,fec_nac,103)as fec_nac from  parientes where cod_epl='".$this->cod_empleado."'";
						 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista9[] =  array("cedula"=>$row["cedula"],
											"nombre"=>$row["nom_par"],
											"apellido"=>$row["ape_par"],
											"ocupacion"=>$row["tip_ocup"],
											"fecha_nac"=>$row["fec_nac"]);				
				}
			
					
		 	
			}else {
				$this->lista9 = NULL;
			}	
		
			return $this->lista9;	
	}
	
	
	
	
	public function vacaciones(){
		
		global $conn;
		
		
		$sql=" select dias_tomados as DIAS_TOMADOS, valor as VALOR,ano AS ANO,fec_cau_ini as FEC_CAU_INI, fec_cau_fin as FEC_CAU_FIN from acumu_vacaciones where cod_epl='".$this->cod_empleado."' order by ano desc";
						 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista10[] =  array("dias"=>$row["DIAS_TOMADOS"],
											"valor"=>$row["VALOR"],
											"ano"=>$row["ANO"],
											"inicial"=>$row["FEC_CAU_INI"],
											"final"=>$row["FEC_CAU_FIN"]);	
				}
			
			}else {
				$this->lista10 = NULL;
			}	
	
			return $this->lista10;	
	}
	
	
	
//TASLADOS DE AREA	
	public function hist_centro_costo(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de centro de costo
         
         $sql="select fecha,
               b.nom_cc2 as anterior,c.nom_cc2 as actual
               from hist_centrocosto2 a,centrocosto2 b,centrocosto2 c 
               where a.ccos2_ant=b.cod_cc2 
               and a.ccos2_act=c.cod_cc2
               and cod_epl='".$this->cod_empleado."' order by fecha asc";
         
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=$rs->FetchRow()){
                 
                 $this->lista11[]=array("anterior"=>utf8_encode($fila["anterior"]),
                                      "actual"=>utf8_encode($fila["actual"]),
                                      "fecha"=>$fila["fecha"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista11=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista11;
        
    }
	
	
	
	public function historico_cargos(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de cargos
         
         $sql="select fecha,
              c1.nom_car as anterior,c2.nom_car as actual,
              observacion,usuario
              from historia_cargo h,cargos c1, cargos c2
              where h.cargo_ant = c1.cod_car
	      and h.cargo_act = c2.cod_car
	      and cod_epl='".$this->cod_empleado."' order by fecha asc";
         
                 
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista12[]=array("anterior"=>$fila["anterior"],
                                      "actual"=>$fila["actual"],
                                      "observacion"=>utf8_encode($fila["observacion"]),
                                      "usuario"=>$fila["usuario"],
                                      "fecha"=>$fila["fecha"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista12=null;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista12;
        
    }
	
	
	
	public function historico_contratos(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
         $sql="select fecha,
               con1.nom_cto as anterior,con2.nom_cto as actual,observacion,usuario
               from historia_contrato h,contratos con1,contratos con2
               where 
               h.contr_ant=con1.cod_cto
               and h.contr_act=con2.cod_cto
               and cod_epl='".$this->cod_empleado."' order by fecha asc";
         
                  
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista13[]=array("anterior"=>$fila["anterior"],
                                      "actual"=>$fila["actual"],
                                      "observacion"=>utf8_encode($fila["observacion"]),
                                      "usuario"=>$fila["usuario"],
                                      "fecha"=>$fila["fecha"]
                                      );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista13=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista13;
    }
	
	 /*
    *@method repor_ultimos_comprobantes Genera los datos
    *de cada comprobante que el usuario selecciona
    */
   public function repor_ultimos_comprobantes($type){
       
       
          try{
        //variable global de conexion
        global $conn;
        
        //Sentencia sql 5 ultimos comprobantes
        $sql="select  convert(int,num_com)as num_com,
           convert(int,per_ini)as per_ini,
              convert(int,ano_ini)as ano_ini ,a.tip_pag,a.liq_ini
              from totales_pago a
              where a.cod_epl='".$this->cod_empleado."' and a.num_com='$this->num_com'
              ORDER BY ano_ini desc";
        
       
        
        //Ejecutamos la sentencia sql
        $rs=$conn->Execute($sql);
        
        //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
        if($rs){
          $fila=@$rs->FetchRow();
                
                switch($type){
               case "periodo":
                   $this->lista16=$fila["per_ini"];
                break;
               case "ano":
                   $this->lista16=$fila["ano_ini"];
                break;
               case "liqui":
                   $this->lista16=$fila["liq_ini"];
                break;
               case "tipo":
                   $this->lista16=$fila["tip_pag"];
                break;
               case "num":
                   $this->lista16=$fila["num_com"];
                break;
      
                }
               
           }else{
               //de lo contrario $this->lista[]==null
             $this->lista16=NULL;
             throw new Exception("No se encontraron datos");
             
           }
        
       }catch(Exception $e){
           
          echo $e->getMessage();
          
       }
    //retornamos los datos
    return $this->lista16;
       
       
   }
   
   
    public function hist_quin_nomina(){

          try{
         
          //variable global de conexion
         global $conn;
        $año=date('Y');
	//$año="2012";
	 
         //Sentencia sql de la NOMINA POR MES
         
         $sql="select tot_dev,tot_ded, (tot_dev - tot_ded)as total
	       from totales_pago
	       where ano_ini='".$año."' and liq_ini = '01' 
	       and per_ini in(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24)
	       and tip_pag ='02'
	       and cod_emp = 1 
               and cod_epl='".$this->cod_empleado."'";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("devengo"=>$fila["tot_dev"],
                               "deducciones"=>$fila["tot_ded"],
                               "total"=>$fila["total"]);
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista=null;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista;
             
}


//Ausencia Por Mes
	public function ausencias_por_mes(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
         $sql="select dias, convert(varchar,fec_ini,110)as fec_ini  from ausencias where cod_epl='".$this->cod_empleado."' and fec_ini>=cast('2014/01/01' as datetime)";
         
                  
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista15[]=array("dias"=>$fila["dias"],
                                        "fecha"=>$fila["fec_ini"]
                                       );
                }
            }else{
                //de lo contrario $this->lista[]==null
              $this->lista15=NULL;
              throw new Exception("No se encontraron datos");
              
            }
         
        }catch(Exception $e){
            
           echo $e->getMessage();
           
        }
     //retornamos los datos
     return $this->lista15;
    }
	
	
	public function meses($mes,$dia){
		
		//var_dump($mes);die("");
		
		global $conn;
		$year = date("Y");
		
		//$sql="select * from ausencias a, conceptos c where a.cod_epl=''  and a.fec_ini>='01/$mes/2011' and a.fec_ini<='31/$mes/2011' and a.cod_con=c.cod_con";
		$sql="select cod_epl as COD_EPL,dias AS DIAS,nom_con AS NOM_CON,convert(varchar,fec_ini,103) as FEC_INI, convert(varchar,fec_fin,103) as FEC_FIN, convert(varchar,fec_fin_r,103) as FEC_FIN_R,convert(varchar,fec_ini_r,103) as FEC_INI_R  from ausencias a, conceptos c where a.cod_epl='".$this->cod_empleado."' and a.fec_ini>=CAST('$year/01/$mes' as datetime) and a.fec_ini<=cast('$year/$dia/$mes' as datetime) and a.cod_con=c.cod_con";
		//$sql="select TO_CHAR(FEC_INI,'DD-MON-YYYY')as FEC_INI, DIAS, COD_EPL, NOM_CON from ausencias a, conceptos c where a.cod_epl='MACS01'  and FEC_INI>=TO_DATE('2011-$mes-01','YYYY-MM-DD') and FEC_INI<=TO_DATE('2011-$mes-$dia','YYYY-MM-DD') and a.cod_con=c.cod_con";	
			
			//var_dump($mes);die($sql);			 
		 	$res=$conn->Execute($sql);
		 
		 	if($res){
			 
				while($row = $res->FetchRow()){

					$this->lista17[] =  array(			"codigo"=>$row["COD_EPL"],
											"dias"=>$row["DIAS"],
											"fecha_ini"=>$row["FEC_INI"],
											"fecha_fin"=>$row["FEC_FIN"],
											"fecha_ini_r"=>$row["FEC_INI_R"],
											"fecha_fin_r"=>$row["FEC_FIN_R"],
											"tipo_de_ausencia"=>$row["NOM_CON"]);				
				}
			
					
		 	
			}else {
				$this->lista17 = NULL;
			}	
		
			return $this->lista17;	
	}
	
	



	
	
	
}

?>
