<?php
include_once('adodb/adodb.inc.php');

/*$server = "VILLAMARIN";
$user = "userTalento";
$pass = "tytcali";
$server = "C2234\cmi2012DEV";
$user = "sa";
$pass = "tytcali";
$db = "TYTCMI2";*/
$odbc="odbc_mssql";

$is_connect = false;

$conn = ADONewConnection($odbc);


$dsn = "Driver={SQL Server};Server=C2234\CMI2012DEV;Database=TalentoDev02;";
$conn->Connect($dsn,'userTalentos','cmiTalent2012');
$conn->SetFetchMode(ADODB_FETCH_ASSOC);

if($conn->isConnected())$is_connect=true;
else $is_connect=false;

?>