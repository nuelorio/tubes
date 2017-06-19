<?php include 'isi/header.php'; ?>
<?php
	$errors = array();
	if(isset($_POST['registrasi'])){
		//ngambil variabel
		$username = sanitize($_POST['username']);
		$password = md5(sanitize($_POST['password']));
		$tempat_lahir = sanitize($_POST['tempat_lahir']);
		$email = sanitize($_POST['email']);
		$tanggal_lahir = sanitize($_POST['tanggal_lahir']);
		$no_hp = sanitize($_POST['no_hp']);
		if(!isset($_POST['kelamin']) || $_POST['kelamin'] == false){
			$_POST['kelamin'] = '';
		}else{
			$kelamin = $_POST['kelamin'];
		}
		//cek error
		
		$sql = "SELECT * FROM pengguna WHERE username = '$username'";
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errors[] .= 'username sudah ada';
		}	
		//cek username kalo ada di database
		$sql5 = "SELECT * FROM pengguna WHERE email = '$email'";
		$result5 = $db->query($sql5);
		$count5 = mysqli_num_rows($result5);
		if($count5 > 0){
			$errors[] .= 'email sudah ada';
		}
		if(!empty($errors)){
			echo display_errors($errors);
		}else{
			$sql="INSERT INTO pengguna SET username = '$username', password = '$password', email = '$email', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', gender = '$kelamin',  no_hp = '$no_hp'";
			$db->query($sql);
			header('Location:register.php');
		}
	}
	
	
?>
<fieldset class="container">
	<div class="col-md-3"></div>
	<form class="col-md-6" action="register.php" method="post" id="bagi-form">
	
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
		
		<div class="form-group">
			<label for="email">Email:</label><br>
			<input type="email" name="email" id="email" class="form-control" value="<?=((isset($_POST['email']))?$_POST['email']:'');?>" 	
			required >
		</div>
		
		<div class="form-group">
			<label for="tempat_lahir">Tempat Lahir:</label><br>
			<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?=((isset($_POST['tempat_lahir']))?$_POST['tempat_lahir']:'');?>" 
			required oninvalid="this.setCustomValidity('tolong isi tempat lahir')"
			oninput="setCustomValidity('')">
		</div>
		
		<div class="form-group">
			<label for="no_hp">nomor telepon / hp:</label><br>
			<input type="text" name="no_hp" id="no_hp" class="form-control" value="<?=((isset($_POST['tempat_lahir']))?$_POST['tempat_lahir']:'');?>" 
			required oninvalid="this.setCustomValidity('tolong isi nomor yang dapat dihubungi')"
			oninput="setCustomValidity('')">
		</div>
		
		<div class="form-group">
			<label for="tanggal_lahir">Tanggal Lahir:</label><br>
			<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?=((isset($_POST['tanggal_lahir']))?$_POST['tanggal_lahir']:'');?>" 
			required oninvalid="this.setCustomValidity('tolong isi tanggal lahir')"
			oninput="setCustomValidity('')">
		</div>
				
		<div class="form-group">
			<?php
				function createRadioOption($name, $value, $labelText) {
					$checked = '';
					$set = "this.setCustomValidity('tolong isi tanggal lahir')";
					if ((isset($_POST[$name]) && $_POST[$name] == $value)) {
						$checked = ' checked="checked"';
					}	
					
					echo('<input type="radio" name="'. $name .'" value="'. $value .'"'. $checked .' required oninvalid="'. $set .'"/><label>'. $labelText .'</label>');
				}
			?>

			<div>
				<label for="kelamin">Jenis Kelamin:</label><br>
				<?php createRadioOption('kelamin', '1',  'Laki-laki'); ?>
				<?php createRadioOption('kelamin', '2',  'Perempuan'); ?>
			</div>
		</div>
		
		<div class="form-group col-md-12 text-center">
			<input type="submit" name="registrasi" value="Registrasi" class="btn btn-success">
		</div>
	</form>
	<div class="col-md-3"></div>
</fieldset>

<?php include 'isi/footer.php'; ?>
