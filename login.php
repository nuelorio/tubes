<?php include 'isi/header.php'; ?>
<?php
	//check if form is submitted
	if (isset($_POST['login'])) {
    	session_start();
		$username = sanitize(mysqli_real_escape_string($db, $_POST['username']));
		$password = sanitize(mysqli_real_escape_string($db, $_POST['password']));
		if($username == "root" && $password == "admin123"){
			$_SESSION['username'] = "root";
			header("Location: superadmin/index.php");
			session_write_close();
		}
		$result = mysqli_query($db, "SELECT * FROM pengguna WHERE username = '" . $username. "' and password = '" . md5($password) . "'");

		if ($row = mysqli_fetch_array($result)) {
			$_SESSION['username'] = $row['username'];
			header("Location: pengguna/index.php");
			session_write_close();
		} else {
			$errormsg = "Incorrect Username or Password!!!";
		}
	}
?>

<fieldset class="container">
	<div class="col-md-3"></div>
	<form class="col-md-6" action="login.php" method="post" id="bagi-form">
	
		<div class="form-group">
			<label for="username">Username:</label><br>
			<input type="text" name="username" id="username" class="form-control" 
			value="<?=((isset($_POST['username']))?$_POST['username']:'');?>" 
			required oninvalid="this.setCustomValidity('tolong isi username')"
			oninput="setCustomValidity('')">
		</div>
		<div class="form-group">
			<label for="password">Password:</label><br>
			<input type="password" name="password" id="password" class="form-control" 
			value="<?=((isset($_POST['password']))?$_POST['password']:'');?>" 
			required oninvalid="this.setCustomValidity('tolong isi password')"
			oninput="setCustomValidity('')">
		</div>
		<div class="form-group col-md-12 text-center">
			<input type="submit" name="login" value="Login" class="btn btn-success">
		</div>
	</form>
	<div class="col-md-3"></div>
</fieldset>

<?php include 'isi/footer.php'; ?>
