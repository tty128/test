<?php
	require_once('./SqlCon.php');

	$action = new SqlCon();

	$eventId = null;
	// �C�x���gID�擾
	if (isset($_POST['eventId'])) {
		$eventId = $_POST['eventId'];
	}

	switch ('save') {

		// DBsave
		case 'save':
		
			$action->postSql($_POST);
			echo "ss";
			echo $_POST['name'];
			echo $_POST['pass'];
			echo $_POST['email'];
			break;

		// ����A�N�Z�X���A���e��ʕ\��
		default:
			echo "ff";
			break;
	}

?>