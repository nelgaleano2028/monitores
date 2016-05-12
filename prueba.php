<?php

require_once 'lib/connection.php';

  global $conn, $is_connect;

//$sql="select * from tmp_parientes";

/*$sql="select *
              from tmp_cap_fictec a       
              where     
              a.tip_est = 'F'
              and cod_epl='1130608594'";*/



/*$sql="select a.cod_ciu AS COD_CIU,f.nom_ciu AS NOM_CIU
              from cap_fictec a,ciudades f         
              where     
              a.tip_est = 'F'
			  and a.cod_ciu = f.cod_ciu
              and cod_epl='1130608594'";*/
			  /*
$sql="select a.cod_clp as COD_CLP,a.cod_ttp AS COD_TTP,
              a.obt_tit AS OBT_TIT,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,a.tiempo AS TIEMPO,
              a.cod_uni AS COD_UNI,a.cod_enti AS COD_ENTI,
              a.cod_ciu AS COD_CIU,a.cod_pai AS COD_PAI,f.nom_ciu AS NOM_CIU
              from cap_fictec a, ciudades f
              where
              a.cod_ciu = f.cod_ciu
              and a.tip_est = 'F'
              and cod_epl='1130608594'"; */
			  
/*$sql="select a.cod_epl,a.cod_clp as COD_CLP,b.nom_est AS NOM_EST,a.cod_ttp AS COD_TTP,c.desc_ttp AS DESC_TTP,
              a.obt_tit AS OBT_TIT,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,a.tiempo AS TIEMPO,
              a.cod_uni AS COD_UNI,d.cod_uni AS COD_UNI2,a.cod_enti AS COD_ENTI,
              e.nom_enti AS NOM_ENTI,a.cod_ciu AS COD_CIU,f.nom_ciu AS NOM_CIU,
              a.cod_pai AS COD_PAI,g.nom_pai AS NOM_PAI,d.nom_uni as NOM_UNI
              from cap_fictec a,estudios b,titulos c,unidades d, entid_cp e,
              ciudades f,paises g
              where a.cod_clp = b.cod_est
              and a.cod_ttp = c.cod_ttp
              and a.cod_uni = d.cod_uni
              and a.cod_ciu = f.cod_ciu
              and a.cod_pai = g.cod_pai
              and a.tip_est = 'F'
              and a.cod_enti = e.cod_enti
              and a.cod_clp='$estudio' and a.cod_ttp='$titulo'
              and cod_epl='1130608594'
        ";*/
		
	/*$sql="select * from  cap_fictec
              where  cod_epl='1130608594'
             ";*/
			 
/*$sql="insert into cap_fictec
              values('$empl','F','$estudios ','$titulo',
              'si',NULL,NULL,NULL,NULL,
              (CONVERT(char(19), '$fechaini 00:00:00 a.m.',113)),
			  (CONVERT(char(19), '$fechafin 00:00:00 a.m.',113)),
             '$tiempo','$tiempouni',
             '$entidad','$ciudad','$pais',NULL)
             ";*/

	
/*$sql="select a.cod_clp as COD_CLP,b.nom_est AS NOM_EST,a.cod_ttp AS COD_TTP,c.desc_ttp AS DESC_TTP,
              a.obt_tit AS OBT_TIT,a.fec_ini AS FEC_INI,a.fec_fin AS FEC_FIN,a.tiempo AS TIEMPO,
              a.cod_uni AS COD_UNI,d.cod_uni AS COD_UNI2,a.cod_enti AS COD_ENTI,
              e.nom_enti AS NOM_ENTI,a.cod_ciu AS COD_CIU,f.nom_ciu AS NOM_CIU,
              a.cod_pai AS COD_PAI,g.nom_pai AS NOM_PAI
              from tmp_cap_fictec a,estudios b,titulos c,unidades d, entid_cp e,
              ciudades f,paises g
              where a.cod_clp = b.cod_est
              and a.cod_ttp = c.cod_ttp
              and a.cod_uni = d.cod_uni
              and a.cod_ciu = f.cod_ciu
              and a.cod_pai = g.cod_pai
			  and a.cod_enti = e.cod_enti
              and a.tip_est = 'F'
              and a.cod_epl='1130608594'
            
        ";*/
		


/*$sql="CREATE TABLE t_user_so( 
	users  	VARCHAR(200),
	pass  	VARCHAR(200),
	perfil	VARCHAR(200)
	)";
*/

/*$sql="select * from t_user_so";*/


/*$sql="SELECT h.cod_epl,h.ape_epl,h.nom_epl,h.cedula,h.nom_ban,h.num_cta,h.nom_sucur,h.consigna,h.numerocomp,
h.n_dia_ini,h.n_dia_fin,h.n_mes,h.codcon1,h.nomcon1,h.can1,h.val1,h.codcon2,h.nomcon2,h.can2,h.val2,
h.codemp,h.coddep,h.codcc2,h.nomcc2,h.nomcar,h.salbas,h.direpl,h.ubiepl,h.pagina,h.nomcc,h.campo1,
h.cnsctvo,h.ciu_tra,h.nom_ciu_tra,h.codcc,h.nomcc,h.codcar,h.campo5
FROM det_compro h
WHERE  h.codemp = 1  
and h.cod_epl ='35696536'
and   numerocomp in (select num_com from totales_pago 
					where ano_ini = '2013' and liq_ini = '01' 
					and per_ini = '14' 
					and tip_pag = '02' and cod_emp = 1 
					and totales_pago.cod_epl ='35696536'  

					) order by nomcar desc";*/
/*$sql="select * from det_compro where numerocomp='172372.00000'";*/
/*$sql="select num_com from totales_pago 
					where ano_ini = '2013' and liq_ini = '01' 
					and per_ini = '7' 
					and tip_pag = '02' and cod_emp = 1 
					and totales_pago.cod_epl ='35696536' ";*/
/*$sql="select ano_ini,per_ini,tip_pag,liq_ini from totales_pago where num_com='184061'";*/
/*$sql = "select *
from empleados_basic
";*/

/*$sql="select id_historia, (CASE WHEN so.cod_historia = 'I' then 'HISTORIA DE INGRESO' else
            (case when so.cod_historia = 'P' then 'HISTORIA PERIODICA' else 
            (case when so.cod_historia = 'E' then 'HISTORIA EGRESO' 
            else 'HISTORIA REINGRESO' end) END) end) as Tipo_Examen, so.fecha , e.cod_epl, RTRIM(e.nom_epl)+' '+RTRIM(e.ape_epl) as Nombre,
            c.nom_car, c2.nom_cc2 
            from so_his_clinica_enc so, empleados_basic e, cargos c , centrocosto2 c2 
            where e.cod_epl = so.cod_epl 
            and e.cod_car = c.cod_car and c2.cod_cc2 = e.cod_cc2 
            and so.COD_EPL = '1130608594'";*/
			
			
$sql = "select * from t_nuevo_pass";

 $res=$conn->Execute($sql);


echo "<table border='1'>";

while($reg= $res->FetchRow())
{
	echo "<tr>";
	foreach($reg as $key => $value){ 
		
			echo '<td>'.$value.'</td>';
		
	}
	echo "</tr>";
}

echo "</table>";

 ?>


