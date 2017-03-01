<?php

function warnlog($gName,$uName,$message){
	$u =exec('whoami');
	$gName = preg_replace('/\s+/', '', $gName);
	$uName = preg_replace('/\s+/', '', $uName);
	$log=$gName." ".$uName." **<WARNING>** ".$message;
	exec("logger -i -t '$u' -p local3.warn '$log'");
}

function errlog($gName,$uName,$message){
	$u =exec('whoami');
	$gName = preg_replace('/\s+/', '', $gName);
	$uName = preg_replace('/\s+/', '', $uName);
	$log=$gName." ".$uName." **<ERROR>** ".$message;
	exec("logger -i -t '$u' -p local2.err '$log'");
}

function infolog($gName,$uName,$message,$infoType){
	$u =exec('whoami');
	$gName = preg_replace('/\s+/', '', $gName);
	$uName = preg_replace('/\s+/', '', $uName);
	$infoType = preg_replace('/\s+/', '', $infoType);
	$log=$gName." ".$uName." **<".$infoType.">** ".$message;
	exec("logger -i -t '$u' -p local4.info '$log'");
}



?>
