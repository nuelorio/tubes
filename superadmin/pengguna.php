<?php include 'isi/header.php'; ?>
<?php
	//get pengguna by username2
	$sql = "SELECT * FROM pengguna";
	$results = $db->query($sql);
	$errors = array();

	if(isset($_GET['delete2']) && !empty($_GET['delete2'])){
		$delete_id = $_GET['delete2'];
		$delete_id = sanitize($delete_id);
		$sql = "DELETE FROM pengguna WHERE username = '$delete_id'";
		$db->query($sql);
		header('location:pengguna.php');
	}

	if(isset($_GET['edit2']) && !empty($_GET['edit2'])){
		$edit_id = $_GET['edit2'];
		$edit_id = sanitize($edit_id);
		$sql2 = "SELECT * FROM pengguna WHERE username = '$edit_id'";
		$edit_result =$db->query($sql2);
		$ePeng = mysqli_fetch_assoc($edit_result);
	}

	if(isset($_POST['register'])){
		//ngambil variabel
		$username2 = sanitize($_POST['username2']);
		$password = md5(sanitize($_POST['password']));
		$tempat_lahir = sanitize($_POST['tempat_lahir']);
		$email = sanitize($_POST['email']);
		$tanggal_lahir = sanitize($_POST['tanggal_lahir']);
		$no_hp = sanitize($_POST['no_hp']);
		$jan = $db->query("SELECT id FROM pengguna WHERE username = '$username2'");
		$tumbang = mysqli_fetch_array($jan);
		$id = $tumbang['id'];
		if(!isset($_POST['kelamin']) || $_POST['kelamin'] == false){
			$_POST['kelamin'] = '';
		}else{
			$kelamin = $_POST['kelamin'];
		}
		
		//cek username2 kalo ada di database
		$sql2 = "SELECT * FROM pengguna WHERE username = '$username2'";
		if(isset($_GET['edit2'])){
			$sql2 = "SELECT * FROM pengguna WHERE username = '$username2' AND id != '$id'";
		}
		$result2 = $db->query($sql2);
		$count2 = mysqli_num_rows($result2);
		if($count2 > 0){
			$errors[] .= 'username sudah ada';
		}
		
		//cek email kalo ada di database
		$sql3 = "SELECT * FROM pengguna WHERE email = '$email'";
		if(isset($_GET['edit2'])){
			$sql3 = "SELECT * FROM pengguna WHERE email = '$email' AND id != '$id'";
			
		}
		$result3 = $db->query($sql3);
		$count3 = mysqli_num_rows($result3);
		if($count3 > 0){
			$errors[] .= 'email sudah ada';
		}
		
		
		if(!empty($errors)){
			echo display_errors($errors);
		}else{
			
			if(isset($_GET['edit2'])){
				$sql = "UPDATE pengguna SET username = '$username2', password = '$password', email = '$email', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', gender = '$kelamin',  no_hp = '$no_hp'";
				
			}else{
				$sql="INSERT INTO pengguna (username, password, email, tempat_lahir, tanggal_lahir, gender, no_hp) VALUES ('$username2', '$password', '$email', '$tempat_lahir', '$tanggal_lahir', '$kelamin', '$no_hp')";
				$db->query($sql);
				
			}
			header('Location:pengguna.php');
		}
	}
?>
<!--form -->
<div >
	<form class="container" action="pengguna.php<?=(isset($_GET['edit2']))?'?edit2='.$edit_id:''?>" method="post" id="bagi-form" enctype="multipart/form-data">
		<div class="form-group col-md-12">
			<label for="username2">Username:</label><br>
			<input type="text" name="username2" id="username2" class="form-control" value="<?php
			if(isset($_GET['edit2'])){
				echo $ePeng['username'];
			}else{
				echo ((isset($_POST['username2']))?$_POST['username2']:''); 
			}
			?>" 
			required oninvalid="this.setCustomValidity('tolong isi username')"
			oninput="setCustomValidity('')">
		</div>

		<div class="form-group col-md-4">
			<label for="password">Password:</label><br>
			<input type="password" name="password" id="password" class="form-control" value="<?php
			if(isset($_GET['edit2'])){
				echo $ePeng['password'];
			}else{
				echo ((isset($_POST['password']))?$_POST['password']:''); 
			}
			?>" 
			required oninvalid="this.setCustomValidity('tolong isi password')"
			oninput="setCustomValidity('')">
		</div>

		<div class="form-group col-md-4">
			<label for="email">Email:</label><br>
			<input type="email" name="email" id="email" class="form-control" value="<?php
			if(isset($_GET['edit2'])){
				echo $ePeng['email'];
			}else{
				echo ((isset($_POST['email']))?$_POST['email']:''); 
			}
			?>"
			required>
		</div>

		<div class="form-group col-md-4">
			<label for="tempat_lahir">Tempat Lahir:</label><br>
			<input type="tempat_lahir" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?php
			if(isset($_GET['edit2'])){
				echo $ePeng['tempat_lahir'];
			}else{
				echo ((isset($_POST['tempat_lahir']))?$_POST['tempat_lahir']:''); 
			}
			?>"
			required oninvalid="this.setCustomValidity('tolong isi tempat lahir')"
			oninput="setCustomValidity('')">
		</div>

		<div class="form-group col-md-4">
			<label for="tanggal_lahir">Tanggal Lahir:</label><br>
			<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="
			<?php

			if(isset($_GET['edit2'])){
				echo date('m/d/Y',strtotime($ePeng['tanggal_lahir']));
			}else{
				echo ((isset($_POST['tanggal_lahir']))?$_POST['tanggal_lahir']:'');
			}
			?>"
			required oninvalid="this.setCustomValidity('tolong isi tanggal lahir')"
			oninput="setCustomValidity('')">
		</div>

		<div class="form-group col-md-4"> 
			<label for="no_hp">No HP:</label><br>
			<input type="no_hp" name="no_hp" id="no_hp" class="form-control" value="<?php
			if(isset($_GET['edit2'])){
				echo $ePeng['no_hp'];
			}else{
				echo ((isset($_POST['no_hp']))?$_POST['no_hp']:''); 
			}
			?>"
			required oninvalid="this.setCustomValidity('tolong isi no_hp')"
			oninput="setCustomValidity('')">
		</div>

		<div class="form-group col-md-4">
			<?php
				function createRadioOption2($name, $value, $labelText) {
					$checked = '';
					if(isset($_GET['edit2'])){
						$server 	= 'localhost';
						$user		= 'root';
						$pass		= '';
						$database	= 'bangkos';

						$db 		= mysqli_connect($server,$user,$pass,$database);
						if(mysqli_connect_errno()){
							echo 'database bermasalah:'.mysqli_connect_error();
							die();
						}
						$edit_id = $_GET['edit2'];
						$edit_id = sanitize($edit_id);
						$sql2 = "SELECT * FROM pengguna WHERE username = '$edit_id'";
						$edit_result =$db->query($sql2);
						$ePeng = mysqli_fetch_assoc($edit_result);

						if ((isset($ePeng['gender']) && $ePeng['gender'] == $value)) {$checked = ' checked="checked"';}
					}else{
						if ((isset($_POST[$name]) && $_POST[$name] == $value)) {$checked = ' checked="checked"';}	
					}
					echo('<input type="radio" name="'. $name .'" value="'. $value .'"'. $checked .' required/><label>'. $labelText .'</label>');
				}
			?>

			<div>
				<label for="kelamin">Jenis Kelamin:</label><br>
				<?php createRadioOption2('kelamin', '1',  'Laki-laki'); ?>
				<?php createRadioOption2('kelamin', '2',  'Perempuan'); ?>
			</div>
		</div>

		<div class="form-group col-md-12 text-center">
			<input type="submit" name="register" value="<?=((isset($_GET['edit2']))?'Edit' : 'Tambah')?> Pengguna" class="btn btn-success">
			<?php if(isset($_GET['edit2'])): ?>
				<a href="pengguna.php" class="btn btn-default">Cancel</a>
			<?php endif; ?>
		</div>
	</form>
</div>

<!--tabel pengguna -->
<div class="container">
	<table class = "table table-bordered table-striped table-auto table-condensed">
		<thead>
			<th>No</th><th>List Pengguna</th><th>Password</th><th>Email</th><th>Tempat Lahir</th><th>Tanggal Lahir</th><th>Gender</th><th>No HP</th><th>Waktu Ditambahkan</th><th>Edit</th><th>Hapus</th>
		</thead>
		<tbody>
			<?php $i = 0; ?>
			<?php while($pengguna = mysqli_fetch_assoc($results)):?>
			<tr>
				<td><?= $i=$i+1; ?></td>
				<td><?= $pengguna['username']?></td>
				<td><?= $pengguna['password']?></td>
				<td><?= $pengguna['email']?></td>
				<td><?= $pengguna['tempat_lahir']?></td>
				<td><?= $pengguna['tanggal_lahir']?></td>
				<td><?php 
					if($pengguna['gender'] == 2){
						echo ('perempuan');
					}else if($pengguna['gender'] == 1){
						echo ('laki-laki');
					}else{
						echo ('error');
					}
				?></td>
				<td><?= $pengguna['no_hp']?></td>
				<td><?= $pengguna['waktu']?></td>
				<td>
					<a href="pengguna.php?edit2=<?= $pengguna['username']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
				</td>
				<td>
					<a href="pengguna.php?delete2=<?= $pengguna['username']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
<?php include 'isi/footer.php'; ?>