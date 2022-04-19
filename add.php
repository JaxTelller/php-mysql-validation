
<?php
$surname = $name = $isikukood = $grade = $email = $message = '';

//ассоциативный массив ошибок
$errors = array('name'=>'', 'surname'=>'', 'email'=>'', 'isikukood'=>'', 'grade'=>'');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['submit'])){
	
	
/*ФУНКЦИИ*/
//обработка данных
function validate_input($data) {
  $data = trim($data); //Удаляет пробелы
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//Имена и фамилии
function validate_input_names($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strtolower($data);
  $data = ucfirst($data);
  return $data;
	
}
//Email
function validate_input_email($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = strtolower($data);
  return $data;
  
 /* $needle = "@";
  $pos = strpos($InputEmail, $needle);
  if($pos === false){
	  return $flag = false;
	  	  
  }else{
	  return $InputEmail;
  } */
}


/*VALIDATION*/
$name = $_POST['name'];
//name validate
  if (empty($_POST["name"])) {
    $errors['name'] = 'Name is required';
  } else {
    $name = validate_input_names($name);
	// preg_match — Выполняет проверку на соответствие регулярному выражению
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $errors['name'] = 'Only letters and white space allowed';
    }
  }
  
$surname = $_POST['surname'];
 //surname validate
  if (empty($_POST["surname"])) {
    $errors['surname'] = 'Surname is required';
  } else {
    $surname = validate_input_names($_POST["surname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$surname)) {
      $errors['surname'] = 'Only letters and white space allowed';
    }
  } 
  
$email = $_POST['email'];
//email validate
  if (empty($_POST["email"])) {
    $errors['email'] = 'Email is required';
  } else {	  
    $email = validate_input_email($_POST["email"]);
	//filter_var — Фильтрует переменную с помощью определённого фильтра
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Invalid email format';
    }
  }
  
$isikukood = $_POST['isikukood'];
//Isikukood validation   
  if (empty($_POST["isikukood"])) {
    $errors['isikukood'] = 'Isikukood(ID) required';
  } else {
    $isikukood = validate_input($_POST["isikukood"]);
    if (!preg_match("/^[0-9]{11,11}$/i",$isikukood)) {
      $errors['isikukood'] = 'Invalid Isukukood(ID)';
    }
  }
  
//Grade validation
	if (empty($_POST["grade"])) {
		$errors['grade'] = 'Grade is required';
	  } else {
		$grade = $_POST['grade'];
		$grade = validate_input($_POST["grade"]);
	  }
	  
$message = $_POST['message'];
//Message validation
  if (empty($_POST["message"])) {
    $message = "";
  } else {
    $message = validate_input($_POST["message"]);
  }
  //проверка на наличие ошибок
 if(array_filter($errors)){
	 
 }else {
/*CONNECTION SELECT INSERT*/ 
	 $conn = mysqli_connect('localhost', 'root', '', 'exam');
	if (mysqli_connect_error()) {
		die('Connection error('. mysqli_connect_errno().')'. mysqli_connect_error()); //Возвращает код и описание ошибки последней попытки соединения
	}else{
			
//SELECT
			$sql = $conn->prepare("SELECT isikukood FROM students WHERE isikukood = ? LIMIT 1");
			$sql->bind_param("s", $isikukood);
			$sql->execute();
			$sql->bind_result($isikukood);
			$sql->store_result();
			$rnum = $sql->num_rows;
			
//INSERT
			if($rnum == 0){
				$sql->close();	
					
				$sql = $conn->prepare("INSERT INTO students(first_name, last_name, email, isikukood, grade, message) VALUES(?, ?, ?, ?, ?, ?)");
				$sql->bind_param('ssssis', $name, $surname, $email, $isikukood, $grade, $message);
				$sql->execute();
				echo $_POST["name"] .'&nbsp'. $_POST["surname"] . " added to DATABASE";
				}
				else{
					echo "Isikukood already exists id DATABASE";		
			
				$sql->close();
				$conn->close();	
				}			
		}
 }
 
}
}
?>