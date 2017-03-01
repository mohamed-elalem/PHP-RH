<?php
include_once "logs.php";
$gName="Logs Team";
$uName="Mohamed Gnedy";
$message="Log Message";
$infoType="Succes s";
warnlog($gName,$uName,$message);
errlog($gName,$uName,$message);
infolog($gName,$uName,$message,$infoType);

?>
