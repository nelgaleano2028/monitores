<?php

include_once("functions.class.php");

$catalogos=new Catalogos;


/*if($_GET["id"]=="01"){
$mes=$catalogos->combo_mes();
}else*/if($_GET["id"]=="02"){
$mes=$catalogos->combo_mes_quin();
}
echo json_encode($mes);
?>