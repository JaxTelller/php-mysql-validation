<?php include 'add.php';?>
<!DOCTYPE html>
<head>

<style>
.error {color: #FF0000;}
}

textarea {
  resize: none;
  height: 80px;
  width: 350px;
}
label{
    display: inline-block;
    float: left;
    clear: left;
    width: 130px;
    text-align: right;
}
#inputfield {
  display: inline-block;
  float: left;
}

</style>
</head>
<body>
<h2>PHP Form Validation EKSAM</h2>

	<p><span class="error">* required field</span></p>
	<form  method="post"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>>

			  <label>Student name:</label> <input id="inputfield" required type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name'];?>">
			  <span class="error">* <?php echo $errors['name'];?></span>
			  <br><br>
			  <label>Student surname:</label> <input id="inputfield" required type="text" name="surname" value="<?php echo $surname;?>">
			  <span class="error">* <?php echo $errors['surname'];?></span>
			  <br><br>
			  <label>Student E-mail:</label> <input id="inputfield" required type="text" name="email" value="<?php echo $email;?>">
			  <span class="error">* <?php echo $errors['email'];?></span>
			  <br><br>
			  <label>Student Isikukood:</label> <input id="inputfield" required type="text" name="isikukood" value="<?php echo $isikukood;?>">
			  <span class="error">* <?php echo $errors['isikukood'];?></span>
			  <br><br>
			  <label>Grade:</label>
			  <input type="radio" name="grade" <?php if (isset($grade) && $grade=="1");?> value="1">1
			  <input type="radio" name="grade" <?php if (isset($grade) && $grade=="2");?> value="2">2
			  <input type="radio" name="grade" <?php if (isset($grade) && $grade=="3");?> value="3">3 
			  <span class="error">* <?php echo $errors['grade'];?></span>
			  <br><br>

			  <label>Your message:</label> <textarea maxlength="250" name="message" rows="3" cols="40"><?php echo $message;?></textarea>
			  <br><br>

			  <input type="submit" name="submit" value="Submit">
			  <input type="reset" value="Cancel">  
			  <input type="button" value="View" onClick="document.location.href='view.php'"/>
	</form>
</body>
</html>