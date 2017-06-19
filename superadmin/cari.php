<?php include 'isi/header.php'; ?>
<?php 
if(isset($_POST['cari'])){
	if(is_null($_POST['namakos']) || $_POST['namakos']==''){
		$namakos='';
	}else{
		$namakos=sanitize($_POST['namakos']);
	}
	if(is_null($_POST['lokasikos']) || $_POST['lokasikos']==''){
		$lokasikos='';
	}else{
		$lokasikos=sanitize($_POST['lokasikos']);
	}
	if(is_null($_POST['tangkos']) || $_POST['tangkos']==''){
		$tangkos='';
	}else{
		$tangkos=sanitize($_POST['tangkos']);
	}
	if(is_null($_POST['wc']) || $_POST['wc']==''){
		$wc='';
	}else{
		$wc=sanitize($_POST['wc']);
	}
	if(is_null($_POST['berisi']) || $_POST['berisi']==''){
		$berisi='';
	}else{
		$berisi=sanitize($_POST['berisi']);
	}
	if(is_null($_POST['ac']) || $_POST['ac']==''){
		$ac='';
	}else{
		$ac=sanitize($_POST['ac']);
	}
	if(is_null($_POST['dapur']) || $_POST['dapur']==''){
		$dapur='';
	}else{
		$dapur=sanitize($_POST['dapur']);
	}
	if(is_null($_POST['mobil']) || $_POST['mobil']==''){
		$mobil='';
	}else{
		$mobil=sanitize($_POST['mobil']);
	}
	if(is_null($_POST['motor']) || $_POST['motor']==''){
		$motor='';
	}else{
		$motor=sanitize($_POST['motor']);
	}
	if(is_null($_POST['kat']) || $_POST['kat']==''){
		$kat='';
	}else{
		$kat=sanitize($_POST['kat']);
	}
	header("location: index.php?namakos=$namakos&lokasikos=$lokasikos&tangkos=$tangkos&wc=$wc&berisi=$berisi&ac=$ac&dapur=$dapur&mobil=$mobil&motor=$motor&kat=$kat");
}
?>
<h3 class="text-center"><b>Pencarian</b></h3>
<form class="container" method="post">
	<div class="form-group col-md-4">
		<label for="namakos">Nama Kos:</label><br>
		<input type="text" name="namakos" class="form-control">
	</div>
	<div class="form-group col-md-4">
		<label for="lokasikos">Lokasi Kos:</label><br>
		<input type="text" name="lokasikos" class="form-control">
	</div>
	<div class="form-group col-md-4">
		<label for="tangkos">Penanggung Jawab Kos:</label><br>
		<input type="text" name="tangkos" class="form-control">
	</div>
	<div class="form-group col-md-12 text-center">
		<label for="fasilitas">Fasilitas:</label><br>
		<div class="col-md-2">
			<b>WC di dalam Kamar:</b><br>
			<input type="radio" name="wc" value="1"><label>Ya</label>
			<input type="radio" name="wc" value="0"><label>Tidak</label>
		</div>
		<div class="col-md-2">
			<b>Kamar Berisi:</b><br>
			<input type="radio" name="berisi" value="1"><label>Ya</label>
			<input type="radio" name="berisi" value="0"><label>Tidak</label>
		</div>
		<div class="col-md-2">
			<b>Kamar BerAC:</b><br>
			<input type="radio" name="ac" value="1"><label>Ya</label>
			<input type="radio" name="ac" value="0"><label>Tidak</label>
		</div>
		<div class="col-md-2">
			<b>Dapur Umum:</b><br>
			<input type="radio" name="dapur" value="1"><label>Ada</label>
			<input type="radio" name="dapur" value="0"><label>Tidak</label>
		</div>
		<div class="col-md-2">
			<b>Parkir Mobil:</b><br>
			<input type="radio" name="mobil" value="1"><label>Ada</label>
			<input type="radio" name="mobil" value="0"><label>Tidak</label>
		</div>
		<div class="col-md-2">
			<b>Parkir Motor:</b><br>
			<input type="radio" name="motor" value="1"><label>Ada</label>
			<input type="radio" name="motor" value="0"><label>Tidak</label>
		</div>
	</div>
	<div class="form-group col-md-12 text-center">
		<b>Kost:</b><br>
		<input type="radio" name="kat" value="1"><label>Kost Laki-laki</label>
		<input type="radio" name="kat" value="2"><label>Kost Perempuan</label>
		<input type="radio" name="kat" value="3"><label>Kost Campur</label>
	</div>
	<div class="form-group col-md-12 text-center">
		<input type="submit" name="cari" value="Cari" class="btn btn-success">
	</div>
</form>
<?php include 'isi/footer.php'; ?>
