<?php

include_once '../lib/connection.php';

class hoja{
    
   private $lista;
   private $codigo;
    
    /*
     *@method ultimos_comprobantes
     *Genera los ultimos 5 comprobantes del empleado
     */
    public function ultimos_comprobantes(){
     
     try{
         //variable global de conexion
         global $conn;
         
         //Sentencia sql 5 ultimos comprobantes
         $sql="select top(5) convert(int,num_com)as num_com,
               b.nom_liq,convert(int,per_ini)as per_ini,
               convert(int,ano_ini)as ano_ini ,
               convert(varchar,fecha,110)as fecha
               from totales_pago a,liquidacion b
               where b.cod_liq=a.liq_ini and a.cod_epl='$this->codigo'
               ORDER BY ano_ini desc";
         
         //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
         //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("numero"=>$fila["num_com"],
                                      "liquidacion"=>utf8_encode($fila["nom_liq"]),
                                      "periodo"=>$fila["per_ini"],
                                      "ano"=>$fila["ano_ini"],
                                      "fecha"=>$fila["fecha"]
                                      );
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
    
    /*
     *@method hist_centro_costo
     *Genera el historico del centro
     *de costo de un empleado
     */
    public function hist_centro_costo(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de centro de costo
         
         $sql="select convert(varchar,fecha,110)as fecha,
               b.nom_cc as anterior,c.nom_cc as actual,
               observacion,usuario
               from hist_centrocosto a,centrocosto b,centrocosto c 
               where a.ccost_ant=b.cod_cc 
               and a.ccost_act=c.cod_cc
               and cod_epl='$this->codigo'";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("anterior"=>$fila["anterior"],
                                      "actual"=>$fila["actual"],
                                      "observacion"=>utf8_encode($fila["observacion"]),
                                      "usuario"=>$fila["usuario"],
                                      "fecha"=>$fila["fecha"]
                                      );
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
    
    /*
     *@method historico_cargos
     *Genera el historico de cargos de un empleado
     *
     */
    
    public function historico_cargos(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de cargos
         
         $sql="select convert(varchar,fecha,110)as fecha,
              c1.nom_car as anterior,c2.nom_car as actual,
              observacion,usuario
              from historia_cargo h,cargos c1, cargos c2
              where h.cargo_ant = c1.cod_car
	      and h.cargo_act = c2.cod_car
	      and cod_epl='$this->codigo' ";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("anterior"=>$fila["anterior"],
                                      "actual"=>$fila["actual"],
                                      "observacion"=>utf8_encode($fila["observacion"]),
                                      "usuario"=>$fila["usuario"],
                                      "fecha"=>$fila["fecha"]
                                      );
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
    
    /*
     *@method historico_contratos
     *Genera el historico de contratos de un empleado
     */
    public function historico_contratos(){
        
         try{
         
          //variable global de conexion
         global $conn;
         
         //Sentencia sql del historico de contratos
         
         $sql="select convert(varchar,fecha,110)as fecha,
               con1.nom_cto as anterior,con2.nom_cto as actual,observacion,usuario
               from historia_contrato h,contratos con1,contratos con2
               where 
               h.contr_ant=con1.cod_cto
               and h.contr_act=con2.cod_cto
               and cod_epl='$this->codigo'";
         
          //objeto que me almacena y retorna los datos
         $this->lista=array();
         
         //Ejecutamos la sentencia sql
         $rs=$conn->Execute($sql);
         
          //validamos si tenemos datos guardamos el resultado en el objeto $this->lista[]
         if($rs){
             while($fila=@$rs->FetchRow()){
                 
                 $this->lista[]=array("anterior"=>$fila["anterior"],
                                      "actual"=>$fila["actual"],
                                      "observacion"=>utf8_encode($fila["observacion"]),
                                      "usuario"=>$fila["usuario"],
                                      "fecha"=>$fila["fecha"]
                                      );
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
    
    
    
    
    /*
     * METODOS SET
     */
    public function set_Codigo($codigo){
        $this->codigo=$codigo;
    }
    
    /*
     * METODOS GET
     */
    
    public function get_Codigo(){
        
        return $this->codigo;
    }
}


?>