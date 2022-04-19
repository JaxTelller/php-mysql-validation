<?php
$conn = mysqli_connect('localhost', 'root', '', 'exam');
	if (mysqli_connect_error()) {
		die('Connection error('. mysqli_connect_errno().')'. mysqli_connect_error()); //Возвращает код и описание ошибки последней попытки соединения
	}else{
		$sql = 'SELECT * FROM students ORDER BY id';
		$result = mysqli_query($conn, $sql); //выполняет запрос к БД
		$students = mysqli_fetch_all($result, MYSQLI_ASSOC); //вставляет все строки в ассоц массив
		
		mysqli_free_result($result); //Освобождает память
		
		mysqli_close($conn);
		
	}
?>

<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
}
.center {
  margin: auto;
  width: 50%;
  padding: 10px;
}
h3 {text-align: center;}
</style>
</head>
<body>



	<h3>Students</h3>
	<div class="container">
		<div class ="row">
		
			<div class = "center">			
				<table style="width:100%">
				
					<tr>
						<th>ID</th>
						<th>First name</th>
						<th>Last name</th>
						<th>Email</th>
						<th>Isikukood</th>
						<th>Grade</th>
						<th>Message</th>
					</tr>
					<?php foreach($students as $student){?>
					<tr>
						<td><?php echo htmlspecialchars($student['id'])?></td>
						<td><?php echo htmlspecialchars($student['first_name'])?></td>
						<td><?php echo htmlspecialchars($student['last_name'])?></td>
						<td><?php echo htmlspecialchars($student['email'])?></td>
						<td><?php echo htmlspecialchars($student['isikukood'])?></td>
						<td><?php echo htmlspecialchars($student['grade'])?></td>
						<td><?php echo htmlspecialchars($student['message'])?></td>				
					</tr>
					<?php } ?>
				 </table>
								
			</div>	
		</div>
	</div>
	<div style="text-align:center;">
		<form action ="del.php" method = "GET">
			<input type="submit" name="Delete" value="Delete">
		</form><br>
		<a href="index.php">Back</a>
	</div>
</body>
</html>