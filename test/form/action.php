<?php
	require_once('./SqlCon.php');

	$action = new SqlCon();

	$eventId = null;
	// イベントID取得
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

		// 初回アクセス時、投稿画面表示
		default:
			echo "ff";
			break;
	}

?>