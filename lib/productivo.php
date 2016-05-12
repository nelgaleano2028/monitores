<?php
include_once('adodb/adodb.inc.php');
$odbc="odbc_mssql";
$conn = ADONewConnection($odbc); 
$dsn = "Driver={SQL Server};Server=C2240\dbExternas01;Database=TalentoCMI;";
$conn->Connect($dsn,'userTalentoCMI','talentoCMI.2012');
$conn->SetFetchMode(ADODB_FETCH_ASSOC);
//Conexion a Mysql.
/*$conn = ADONewConnection("mysql");

$odbc="odbc_mssql";
$conn->PConnect('server', 'user', 'passw', 'database'); */

?>