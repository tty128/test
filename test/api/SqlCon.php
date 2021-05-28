<?php

require('../config.php');

class SqlCon{

	public $mysq = null;

	function __construct(){
		try{
			$this->mysq = new PDO(PDO_DSN,DATABASE_USER,DATABASE_PASSWORD);
		}
		catch(PDOException $e){
			echo "error";
		}
	}

	function postSql($data){
		$smt = $this->mysq->prepare('insert into users (name,pass,email) value(:name,:pass,:email)');
		$smt->bindParam(':name',$data['name'], PDO::PARAM_STR);
		$smt->bindParam(':pass',$data['pass'], PDO::PARAM_STR);
		$smt->bindParam(':email',$data['email'], PDO::PARAM_STR);
		$smt->execute();
		$this->mysq = null;
	}

	function getSql($dir,$find){
		$res = null;
		$smt = null;
		switch($dir){
			case 'user':
				$smt = 'select * from users where id = '.$find;
				break;
			case 'post':
				$smt = 'select * from users where id = '.$find;
				break;
			default:
				break;
		}

		if(isset($smt)){
			$res = $this->mysq->query($smt);
			$fet = $res->fetch(PDO::FETCH_ASSOC);
			echo json_encode($fet);
		}
		$res = null;
		$smt = null;
	}

}


?>