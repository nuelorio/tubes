<?php include 'isi/header.php'; ?>
<?php
	//get list kost by username
	$sql = "SELECT * FROM list_kos";
	$results = $db->query($sql);
	$errors = array();
	
	function createRadioOption($name, $value, $labelText) {
		$checked = '';
		if(isset($_GET['edit'])){
			$server 	= 'localhost';
			$user		= 'root';
			$pass		= '';
			$database	= 'bangkos';

			$db 		= mysqli_connect($server,$user,$pass,$database);
			if(mysqli_connect_errno()){
				echo 'database bermasalah:'.mysqli_connect_error();
				die();
			}
			$edit_id 	 = $_GET['edit'];
			$edit_id	 = sanitize($edit_id);
			$sql2		 = "SELECT * FROM list_kos WHERE id = '$edit_id'";
			$edit_result =$db->query($sql2);
			$eKos		 = mysqli_fetch_assoc($edit_result);
			
			if ((isset($eKos['kategori']) && $eKos['kategori'] == $value)) {$checked = ' checked="checked"';}
		}else{
			if ((isset($_POST[$name]) && $_POST[$name] == $value)) {$checked = ' checked="checked"';}	
		}
		echo('<input type="radio" name="'. $name .'" value="'. $value .'"'. $checked .' required/><label>'. $labelText .'</label>');
	}
	function createRadioOptionForFasilitas($name,$value,$labelText){
		$checked = '';
		if(isset($_GET['edit'])){
			$server 	= 'localhost';
			$user		= 'root';
			$pass		= '';
			$database	= 'bangkos';

			$db 		= mysqli_connect($server,$user,$pass,$database);
			if(mysqli_connect_errno()){
				echo 'database bermasalah:'.mysqli_connect_error();
				die();
			}
			$edit_id		= $_GET['edit'];
			$edit_id 		= sanitize($edit_id);
			$sql2 			= "SELECT * FROM list_kos WHERE id = '$edit_id'";
			$edit_result 	= $db->query($sql2);
			$eKos 			= mysqli_fetch_assoc($edit_result);
			$namaaja		= $eKos['nama_kos'];
			$sql4			= "SELECT * FROM fasilitas WHERE nama_kos = '$namaaja'";
			$edit2_result 	= $db->query($sql4);
			$eKos1 			= mysqli_fetch_assoc($edit2_result);
				
			if ((isset($eKos1[$name]) && $eKos1[$name] == $value)) {$checked = ' checked="checked"';}
		}else{
			if ((isset($_POST[$name]) && $_POST[$name] == $value)) {$checked = ' checked="checked"';}
		}
		echo('<input type="radio" name="'. $name .'" value="'. $value .'"'. $checked .' required/><label>'. $labelText .'</label>');
	}

	//edit list_kos
	if(isset($_GET['edit']) && !empty($_GET['edit'])){
		$edit_id = $_GET['edit'];
		$edit_id = sanitize($edit_id);
		$sql2 = "SELECT * FROM list_kos INNER JOIN fasilitas WHERE list_kos.nama_kos = fasilitas.nama_kos AND list_kos.id = '$edit_id'";
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$edit_result =$db->query($sql2);
		$eKos = mysqli_fetch_assoc($edit_result);
	}

	//delete list_kos
	if(isset($_GET['delete']) && !empty($_GET['delete'])){
		$delete_id = $_GET['delete'];
		$delete_id = sanitize($delete_id);
		$sql = "DELETE list_kos, fasilitas FROM list_kos INNER JOIN fasilitas WHERE list_kos.nama_kos = fasilitas.nama_kos AND list_kos.id = '$delete_id'";
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$db->query($sql);
		header('location:atur.php');
	}

	//if add form is submitted
	if(isset($_POST['add_submit'])){
		$username = sanitize($_POST['username']);
		$namakos = sanitize($_POST['namakos']);
		$lokasi = sanitize(mysql_real_escape_string($_POST['lokasi']));
		$deskripsi = sanitize(mysql_real_escape_string($_POST['deskripsi']));
		$harga = sanitize($_POST['harga']);
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$gambar = $_FILES['gambar'];
			$name = $gambar['name'];
			$nameArray = explode('.',$name);
			$fileName = @$nameArray[0];
			$fileExt = @$nameArray[1];
			$mime = explode('/',$gambar['type']);
			$mimeType = @$mime[0];
			$mimeExt = @$mime[1];
			$tmpLoc = $gambar['tmp_name'];
			$fileSize = $gambar['size'];
			$allowed = array('png','jpg','jpeg','gif');
			
			$uploadName = $fileName.'.'.$fileExt;
			if(file_exists("/img/taik/$fileName")) unlink("/img/taik/$fileName");
			$uploadPath = BASEURL.'img/taik/'.$uploadName;
			$dbPath = '/tubes/img/taik/'.$uploadName;
			
			if($mimeType != 'image'){
				$errors[] = 'file harus gambar.';
			}
			if(!in_array($fileExt, $allowed)){
				$errors[] = 'gambar harus png, jpeg, jpg, atau gif';
			}
			if($fileSize > 1000000){
				$errors[] = 'ukuran file harus dibawah 15MB';
			}
			if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
				$errors[] = 'ekstensi file tidak sesuai dengan file';
			}
		}
		
		
		if(!isset($_POST['kategori']) || $_POST['kategori'] == false){
			$_POST['kategori'] = '';
		}else{
			$kategori = $_POST['kategori'];
		}
		if(!isset($_POST['wc_dalam']) || $_POST['wc_dalam'] == false){
			$_POST['wc_dalam'] = '';
		}else{
			$wc_dalam = $_POST['wc_dalam'];
		}
		if(!isset($_POST['berisi']) || $_POST['berisi'] == false){
			$_POST['berisi'] = '';
		}else{
			$berisi = $_POST['berisi'];
		}
		if(!isset($_POST['ac']) || $_POST['ac'] == false){
			$_POST['ac'] = '';
		}else{
			$ac = $_POST['ac'];
		}
		if(!isset($_POST['dapur']) || $_POST['dapur'] == false){
			$_POST['dapur'] = '';
		}else{
			$dapur = $_POST['dapur'];
		}
		if(!isset($_POST['parkir_mobil']) || $_POST['parkir_mobil'] == false){
			$_POST['parkir_mobil'] = '';
		}else{
			$parkir_mobil = $_POST['parkir_mobil'];
		}
		if(!isset($_POST['parkir_motor']) || $_POST['parkir_motor'] == false){
			$_POST['parkir_motor'] = '';
		}else{
			$parkir_motor = $_POST['parkir_motor'];
		}
		
		//check if list_kos exists in database
		$sql = "SELECT * FROM list_kos INNER JOIN fasilitas ON list_kos.nama_kos = fasilitas.nama_kos WHERE list_kos.nama_kos = '$namakos'";
		if(isset($_GET['edit'])){
			$sql = "SELECT * FROM list_kos INNER JOIN fasilitas ON list_kos.nama_kos = fasilitas.nama_kos WHERE list_kos.nama_kos = '$namakos' AND list_kos.id !='$edit_id'";
		}
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errors[] .= 'nama kos sudah ada';
		}	
		
		//display errors
		if(!empty($errors)){
			echo display_errors($errors);
		}else{
			move_uploaded_file($tmpLoc, $uploadPath);
			$list_kos		= mysqli_fetch_assoc($result);
			$path = $list_kos['gambar'];
			$path = explode('/', $path);
			unset($path[1]);
			$path = implode('/', $path);
			echo $path;
			if(file_exists($path)) unlink($path);
			//add list kos to database
			$sql = "INSERT INTO list_kos (nama_kos, lokasi, deskripsi, kategori, harga, username, gambar) VALUES ('$namakos','$lokasi','$deskripsi','$kategori','$harga','$username', '$dbPath')";
			$sql7 = "INSERT INTO fasilitas (wc_dalam, berisi, ac, dapur, parkir_mobil, parkir_motor, nama_kos) VALUES ('$wc_dalam', '$berisi', '$ac', '$dapur', '$parkir_mobil', '$parkir_motor', '$namakos')";
		 
			if(isset($_GET['edit'])){
				$sql = "UPDATE list_kos SET nama_kos = '$namakos', lokasi = '$lokasi', deskripsi = '$deskripsi', kategori = '$kategori', harga = '$harga', username = '$username', gambar = '$dbPath' WHERE id = '$edit_id'";
				$sql7 = "UPDATE fasilitas SET nama_kos = '$namakos', wc_dalam = '$wc_dalam', berisi = '$berisi', ac = '$ac', dapur = '$dapur', parkir_mobil = '$parkir_mobil', parkir_motor = '$parkir_motor' WHERE id = '$edit_id'"; 
			}
			$db->query($sql);
			$db->query($sql7);
			header('Location:atur.php');
		}
	}
?>
<!doctype html>
<h2 class="text-center">Atur Iklan</h2><hr>
<h4 class="text-center"><?=((isset($_GET['edit']))?'Edit : '.$eKos['nama_kos'].'' : 'Tambah Kos')?> </h4><hr>

<!-- Form -->
<div >
	<form class="container" action="atur.php<?=(isset($_GET['edit']))?'?edit='.$edit_id:''?>" method="post" id="bagi-form" enctype="multipart/form-data">
		<div class="form-group col-md-12">
			<label for="username">username:</label><br>
			<input type="text" name="username" id="username" class="form-control" value="<?php
			if(isset($_GET['edit'])){
				echo $eKos['username'];
			}else{
				echo ((isset($_POST['username']))?$_POST['username']:''); 
			}
			?>" 
			required oninvalid="this.setCustomValidity('tolong isi username')"
			oninput="setCustomValidity('')">
		</div>

		<div class="form-group col-md-4">
			<label for="namakos">Nama Kos:</label><br>
			<input type="text" name="namakos" id="namakos" class="form-control" value="<?php
			if(isset($_GET['edit'])){
				echo $eKos['nama_kos'];
			}else{
				echo ((isset($_POST['namakos']))?$_POST['namakos']:''); 
			}
			?>" 
			required oninvalid="this.setCustomValidity('tolong isi nama kos')"
			oninput="setCustomValidity('')">
		</div>
		
		<div class="form-group col-md-4">
			<label for="harga">Harga Tahunan:</label><br>
			<input type="text" name="harga" id="harga" class="form-control" value="<?php
			if(isset($_GET['edit'])){
				echo $eKos['harga'];
			}else{
				echo ((isset($_POST['harga']))?$_POST['harga']:''); 
			}
			?>"
			required oninvalid="this.setCustomValidity('tolong isi harga tahunan')"
			oninput="setCustomValidity('')">
		</div>

		<?php
		    $file = null;
		    if (!empty($_POST['file'])) {
		        $file = $_POST['file'];
		    }
		    if (!empty($_FILES['file_upload'])) {

		        // process upload, save file somewhere

		        $file = $eKos['gambar'];
		    }
		    // validate form
		?>
		<div class="form-group col-md-4">
			<label for="gambar">Gambar:</label><br>
			<input type="file" name="gambar" id="gambar" class="form-control"
			required oninvalid="this.setCustomValidity('tolong isi Gambar')"
			oninput="setCustomValidity('')">
			<input type="hidden" name="file" value="<?php echo $file; ?>" />
		</div>

		
		<div class="form-group col-md-4"> 
			<label for="lokasi">Lokasi:</label><br>
			<textarea rows="2" name="lokasi" id="lokasi" class="form-control"
			required oninvalid="this.setCustomValidity('tolong isi lokasi')"
			oninput="setCustomValidity('')"
			><?php
			if(isset($_GET['edit'])){
				echo $eKos['lokasi'];
			}else{
				echo ((isset($_POST['lokasi']))?$_POST['lokasi']:''); 
			}
			?></textarea> 
		</div>
		
		<div class="form-group col-md-4"> 
			<label for="deskripsi">Deskripsi:</label><br>
			<textarea rows="2" name="deskripsi" id="deskripsi" class="form-control"
			required oninvalid="this.setCustomValidity('tolong isi deskripsi')"
			oninput="setCustomValidity('')"
			><?php
			if(isset($_GET['edit'])){
				echo $eKos['deskripsi'];
			}else{
				echo ((isset($_POST['deskripsi']))?$_POST['deskripsi']:''); 
			}
			?></textarea> 
		</div>

		<div class="form-group col-md-4">
			<b>Kategori:</b>			
			<div >
				<?php createRadioOption('kategori', '1',  'Kost Pria'); ?><br>
				<?php createRadioOption('kategori', '2',  'Kost Wanita'); ?><br>
				<?php createRadioOption('kategori', '3',  'Kost Campur'); ?><br>
			</div>
		</div>
		
		<div class="form-group col-md-12 text-center">
			<b>Fasilitas:</b><br>
			<div class="col-md-2">
				<b>WC di dalam Kamar:</b><br>
				<?php createRadioOptionForFasilitas('wc_dalam','1','Ada') ?>
				<?php createRadioOptionForFasilitas('wc_dalam','0','Tidak') ?>
			</div>
			<div class="col-md-2">
				<b>Kamar Berisi:</b><br>
				<?php createRadioOptionForFasilitas('berisi','1','Ya') ?>
				<?php createRadioOptionForFasilitas('berisi','0','Tidak') ?>
			</div>
			<div class="col-md-2">
				<b>Kamar BerAC:</b><br>
				<?php createRadioOptionForFasilitas('ac','1','Ya') ?>
				<?php createRadioOptionForFasilitas('ac','0','Tidak') ?>
			</div>
			<div class="col-md-2">
				<b>Dapur Umum:</b><br>
				<?php createRadioOptionForFasilitas('dapur','1','Ada') ?>
				<?php createRadioOptionForFasilitas('dapur','0','Tidak') ?>
			</div>
			<div class="col-md-2">
				<b>Parkir Mobil:</b><br>
				<?php createRadioOptionForFasilitas('parkir_mobil','1','Ada') ?>
				<?php createRadioOptionForFasilitas('parkir_mobil','0','Tidak') ?>
			</div>
			<div class="col-md-2">
				<b>Parkir Motor:</b><br>
				<?php createRadioOptionForFasilitas('parkir_motor','1','Ada') ?>
				<?php createRadioOptionForFasilitas('parkir_motor','0','Tidak') ?>
			</div>		
		</div>

		<div class="form-group col-md-12 text-center">
			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit' : 'Tambah')?> kos" class="btn btn-success">
			<?php if(isset($_GET['edit'])): ?>
				<a href="atur.php" class="btn btn-default">Cancel</a>
			<?php endif; ?>
		</div>
	</form>
</div>

<div class="container">
	<table class = "table table-bordered table-striped table-auto table-condensed">
		<thead>
			<th>No</th><th>List Iklan</th><th>Username</th><th>Harga / Tahun</th><th>Waktu Ditambahkan</th><th>Edit</th>
		</thead>
		<tbody>
			<?php $i = 0; ?>
			<?php while($list_kos = mysqli_fetch_assoc($results)):?>
			<tr>
				<td><?= $i=$i+1; ?></td>
				<td><?= $list_kos['nama_kos']?></td>
				<td><?= $list_kos['username']?></td>
				<td>Rp<?= number_format($list_kos['harga'],2)."<br>"; ?></td>
				<td><?= $list_kos['waktu']?></td>
				<td>
					<a href="atur.php?edit=<?= $list_kos['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="atur.php?delete=<?= $list_kos['id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>

<?php include 'isi/footer.php'; ?>