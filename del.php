<?php
$conn = mysqli_connect('localhost', 'root', '', 'exam');
	if (mysqli_connect_error()) {
		die('Connection error('. mysqli_connect_errno().')'. mysqli_connect_error()); //Возвращает код и описание ошибки последней попытки соединения
	}else{
		$sql = 'TRUNCATE TABLE students';
		mysqli_query($conn, $sql);
		mysqli_close($conn);
		header('Location: view.php'); //redirect 
	}
?>