<?php 

   function checkIden($table,$IdEnt){
	   	global $db;
	   	$row='';
	   	$stm=$db->prepare("SELECT * FROM ".$table." WHERE IdEnt=?");
		$stm->execute([$IdEnt]);
		if ($stm->rowCount() > 0) {
			$row=$stm->fetch();
		}

		return $row;
   }
   function checkTable($table,$item=null,$cin){
	   	global $db;
	   	$row='';
	   	if($item==null){
	   		$item='CIN';
	   	}
	   	$stm=$db->prepare("SELECT * FROM ".$table." WHERE ".$item."=?");
		$stm->execute([$cin]);
		if ($stm->rowCount() > 0) {
			$row=$stm->fetch();
		}

		return $row;
   }




 ?>