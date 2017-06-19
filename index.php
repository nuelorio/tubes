<?php include 'isi/header.php'; ?>
<?php 
error_reporting(E_ALL & ~E_NOTICE);
if(isset($_GET['namakos']) && isset($_GET['lokasikos']) && isset($_GET['tangkos']) && isset($_GET['wc']) && isset($_GET['berisi']) && isset($_GET['ac']) && isset($_GET['dapur']) && isset($_GET['mobil']) && isset($_GET['motor']) && isset($_GET['kat']) || $_GET['namakos']!='' || $_GET['lokasikos']!='' || $_GET['tangkos']!='' || $_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!='' || $_GET['kat']!=''){
	if($_GET['namakos']!='' ){
		if($_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!=''){
			$namakos = " list_kos.nama_kos LIKE ";
		}else{
			$namakos = " nama_kos LIKE ";
		}
		
		$namakos2= $_GET['namakos'];
		$namakos3= $namakos."'%$namakos2%'";
	}else{
		$namakos3="";
	}
	if($_GET['lokasikos']!=''){
		if($namakos3==''){
			if($_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!=''){
				$lokasikos = " list_kos.lokasi LIKE ";
			}else{
				$lokasikos = " lokasi LIKE ";
			}
		}else{
			if($_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!=''){
				$lokasikos = " AND list_kos.lokasi LIKE ";
			}else{
				$lokasikos = " AND lokasi LIKE ";
			}
		}
		$lokasikos2= $_GET['lokasikos'];
		$lokasikos3= $lokasikos."'%$lokasikos2%'";
	}else{
		$lokasikos3="";
	}
	if($_GET['tangkos']!=''){
		if($namakos3=='' && $lokasikos3==''){
			if($_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!=''){
				$tangkos = " list_kos.username LIKE ";
			}else{
				$tangkos = " username LIKE ";
			}
		}else{
			if($_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!=''){
				$tangkos = " AND list_kos.username LIKE ";
			}else{
				$tangkos = " AND username LIKE ";
			}
		}
		$tangkos2= $_GET['tangkos'];
		$tangkos3= $tangkos."'%$tangkos2%'";
	}else{
		$tangkos3="";
	}
	if($_GET['kat']!=''){
		if($namakos3=='' && $lokasikos3=='' && $tangkos3==''){
			if($_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!=''){
				$kat = " list_kos.kategori = ";
			}else{
				$kat = " kategori = ";
			}
		}else{
			if($_GET['wc']!='' || $_GET['berisi']!='' || $_GET['ac']!='' || $_GET['dapur']!='' || $_GET['mobil']!='' || $_GET['motor']!=''){
				$kat = " AND list_kos.kategori = ";
			}else{
				$kat = " AND kategori = ";
			}
		}
		$kat2= $_GET['kat'];
		$kat3= $kat."'$kat2'";
	}else{
		$kat3="";
	}
	if($_GET['wc']!=''){
		if($_GET['namakos']!='' || $_GET['lokasikos']!='' || $_GET['tangkos']!='' || $_GET['kat']!=''){
			$wc = " AND fasilitas.wc_dalam = ";
		}else{
			$wc = " wc_dalam = ";
		}

		$wc2= $_GET['wc'];
		$wc3= $wc."$wc2";
	}else{
		$wc3="";
	}
	if($_GET['berisi']!=''){
		if($_GET['namakos']!='' || $_GET['lokasikos']!='' || $_GET['tangkos']!='' || $_GET['kat']!=''){
			$berisi = " AND fasilitas.berisi = ";
		}else{
			if($wc3!=''){
				$berisi = " AND berisi = ";
			}else{
				$berisi = " berisi = ";
			}
		}
		$berisi2= $_GET['berisi'];
		$berisi3= $berisi."$berisi2";
	}else{
		$berisi3="";
	}
	if($_GET['ac']!=''){
		if($_GET['namakos']!='' || $_GET['lokasikos']!='' || $_GET['tangkos']!='' || $_GET['kat']!=''){
			$ac = " AND fasilitas.ac = ";
		}else{
			if($wc3!='' && $berisi3!=''){
				$ac = " AND ac = ";
			}else{
				$ac = " ac = ";
			}
		}
		$ac2= $_GET['ac'];
		$ac3= $ac."$ac2";
	}else{
		$ac3="";
	}
	if($_GET['dapur']!=''){
		if($_GET['namakos']!='' || $_GET['lokasikos']!='' || $_GET['tangkos']!='' || $_GET['kat']!=''){
			$dapur = " AND fasilitas.dapur = ";
		}else{
			if($wc3!='' && $berisi3!='' && $ac3!=''){
				$dapur = " AND dapur = ";
			}else{
				$dapur = " dapur = ";
			}
		}
		$dapur2= $_GET['dapur'];
		$dapur3= $dapur."$dapur2";
	}else{
		$dapur3="";
	}
	if($_GET['mobil']!=''){
		if($_GET['namakos']!='' || $_GET['lokasikos']!='' || $_GET['tangkos']!='' || $_GET['kat']!=''){
			$mobil = " AND fasilitas.parkir_mobil = ";
		}else{
			if($wc3!='' && $berisi3!='' && $ac3!='' && $dapur3!=""){
				$mobil = " AND parkir_mobil = ";
			}else{
				$mobil = " parkir_mobil = ";
			}
		}
		$mobil2= $_GET['mobil'];
		$mobil3= $mobil."$mobil2";
	}else{
		$mobil3="";
	}
	if($_GET['motor']!=''){
		if($_GET['namakos']!='' || $_GET['lokasikos']!='' || $_GET['tangkos']!='' || $_GET['kat']!=''){
			$motor = " AND fasilitas.parkir_motor = ";
		}else{
			if($wc3!='' && $berisi3!='' && $ac3!='' && $dapur3!=""){
				$motor = " AND parkir_motor = ";
			}else{
				$motor = " parkir_motor = ";
			}
		}
		$motor2= $_GET['motor'];
		$motor3= $motor."$motor2";
	}else{
		$motor3="";
	}
	/*echo $namakos3;
	echo $lokasikos3;
	echo $tangkos3;
	echo $wc3;
	echo $berisi3;
	echo $ac3;
	echo $dapur3;
	echo $mobil3;
	echo $motor3;
	echo $kat3;*/
	
	if($_GET['namakos']=='' && $_GET['lokasikos']=='' && $_GET['tangkos']=='' && $_GET['kat']!=''){
		if(isset($_POST['descend'])){
			$sql2 = "SELECT * FROM fasilitas INNER JOIN list_kos ON list_kos.nama_kos = fasilitas.nama_kos WHERE".$wc3.$berisi3.$ac3.$dapur3.$mobil3.$motor3." ORDER BY harga DESC LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}else if(isset($_POST['ascend'])){
			$sql2 = "SELECT * FROM fasilitas INNER JOIN list_kos ON list_kos.nama_kos = fasilitas.nama_kos WHERE".$wc3.$berisi3.$ac3.$dapur3.$mobil3.$motor3." ORDER BY harga ASC LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}else{
			$sql2 = "SELECT * FROM fasilitas INNER JOIN list_kos ON list_kos.nama_kos = fasilitas.nama_kos WHERE".$wc3.$berisi3.$ac3.$dapur3.$mobil3.$motor3." LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}
	}else if($_GET['wc']=='' && $_GET['berisi']=='' && $_GET['ac']=='' && $_GET['dapur']=='' && $_GET['mobil']=='' && $_GET['motor']==''){
		if(isset($_POST['descend'])){
			$sql2 = "SELECT * FROM list_kos WHERE".$namakos3.$lokasikos3.$tangkos3.$kat3." ORDER BY harga DESC LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}else if(isset($_POST['ascend'])){
			$sql2 = "SELECT * FROM list_kos WHERE".$namakos3.$lokasikos3.$tangkos3.$kat3." ORDER BY harga ASC LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}else{
			$sql2 = "SELECT * FROM list_kos WHERE".$namakos3.$lokasikos3.$tangkos3.$kat3." LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}
		
	}else{
		if(isset($_POST['descend'])){
			$sql2 = "SELECT * FROM fasilitas INNER JOIN list_kos ON list_kos.nama_kos = fasilitas.nama_kos WHERE".$namakos3.$lokasikos3.$tangkos3.$kat3.$wc3.$berisi3.$ac3.$dapur3.$mobil3.$motor3." ORDER BY harga DESC LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}else if(isset($_POST['ascend'])){
			$sql2 = "SELECT * FROM fasilitas INNER JOIN list_kos ON list_kos.nama_kos = fasilitas.nama_kos WHERE".$namakos3.$lokasikos3.$tangkos3.$kat3.$wc3.$berisi3.$ac3.$dapur3.$mobil3.$motor3." ORDER BY harga ASC LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}else{
			$sql2 = "SELECT * FROM fasilitas INNER JOIN list_kos ON list_kos.nama_kos = fasilitas.nama_kos WHERE".$namakos3.$lokasikos3.$tangkos3.$kat3.$wc3.$berisi3.$ac3.$dapur3.$mobil3.$motor3." LIMIT 30";
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		}
	}
}else if(isset($_GET['kategori']) && !empty($_GET['kategori'])){
	$kategori		= $_GET['kategori'];
	$kategori		= sanitize($kategori);
	if(isset($_POST['descend'])){
		$sql2			= "SELECT * FROM list_kos WHERE kategori = '$kategori' ORDER BY harga DESC LIMIT 30";
	}else if(isset($_POST['ascend'])){
		$sql2			= "SELECT * FROM list_kos WHERE kategori = '$kategori' ORDER BY harga ASC LIMIT 30";
	}else{
		$sql2			= "SELECT * FROM list_kos WHERE kategori = '$kategori' LIMIT 30";	
	}
}else{
	if(isset($_POST['descend'])){
		$sql2			= "SELECT * FROM list_kos ORDER BY harga DESC LIMIT 30";
	}else if(isset($_POST['ascend'])){
		$sql2			= "SELECT * FROM list_kos ORDER BY harga ASC LIMIT 30";
	}else{
		$sql2			= "SELECT * FROM list_kos LIMIT 30";
	}
}
$kategori_result= $db->query($sql2);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>

<div class="container">
	<div class="col-md-2" id="list-thumbnail">
		<form action="#" method="post" id="descend">
			<input type="submit" name="descend" value="Harga Tinggi -> Rendah" class="btn btn-default">
		</form>
		<form action="#" method="post" id="ascend">
			<input type="submit" name="ascend" value="Harga Rendah -> Tinggi" class="btn btn-default">
		</form>
		<h4><b>Legenda:</b></h4>
		<ul id="legenda">
			<li>
				<i class="fa fa-shower"></i> : wc dalam
			</li>
			<li>
				<i class="fa fa-bed"></i> : kamar berisi
			</li>
			<li>
				<i class="fa fa-snowflake-o"></i> : kamar berAC
			</li>
			<li>
				<i class="fa fa-cutlery"></i> : ada dapur
			</li>
			<li>
				<i class="fa fa-car"></i> : ada parkir mobil
			</li>
			<li>
				<i class="fa fa-motorcycle"></i> : ada parkir motor
			</li>
			<li>
				<i class="fa fa-close"></i> : fasilitas bersangkutan tidak ada
			</li>
		</ul>
	</div>
	<div class="col-md-10" id="list-thumbnail">
		<div class="row">
			<?php while($eKategori = mysqli_fetch_assoc($kategori_result)): ?>
				<?php
				$nama 		= mysqli_real_escape_string($db,$eKategori['nama_kos']);
				$sql3		= "SELECT * FROM fasilitas WHERE nama_kos = '$nama'";
				$fresult	= $db->query($sql3);
				$eFasilitas = mysqli_fetch_assoc($fresult);
				?>
				<div class="col-md-3" id="big-thumbnail">
					<div id="thumbnail-item">
						<div id="image-thumbnail">
							<img src=<?= $eKategori['gambar']?> alt="Jika anda melihat tulisan ini maka ada masalah pada database ketika menampilkan gambar" class="img-thumb">
						</div>
						<div id="text-thumbnail">
							<?php if($eFasilitas['wc_dalam']==1){ ?>
								<i class="fa fa-shower"></i>
							<?php }else{ ?>
								<i class="fa fa-close"></i>
							<?php } ?>
							<?php if($eFasilitas['berisi']==1){ ?>
								<i class="fa fa-bed"></i>
							<?php }else{ ?>
								<i class="fa fa-close"></i>
							<?php } ?>
							<?php if($eFasilitas['ac']==1){ ?>
								<i class="fa fa-snowflake-o"></i>
							<?php }else{ ?>
								<i class="fa fa-close"></i>
							<?php } ?>
							<?php if($eFasilitas['dapur']==1){ ?>
								<i class="fa fa-cutlery"></i>
							<?php }else{ ?>
								<i class="fa fa-close"></i>
							<?php } ?>
							<?php if($eFasilitas['parkir_mobil']==1){ ?>
								<i class="fa fa-car"></i>
							<?php }else{ ?>
								<i class="fa fa-close"></i>
							<?php } ?>
							<?php if($eFasilitas['parkir_motor']==1){ ?>
								<i class="fa fa-motorcycle"></i>
							<?php }else{ ?>
								<i class="fa fa-close"></i>
							<?php } ?>

							<p><b><?= $eKategori['nama_kos'] ?></b></p>
							<small><?= $eKategori['lokasi'] ?></small>
							<p class="price">Rp
								<?= number_format($eKategori['harga'],2)."/tahun"; ?>
							</p>

							<button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $eKategori['id'];?>)" id="button-rinci">Lebih Rinci</button>
							<?= $eKategori['id'];?>
						</div>
					</div>
				</div>
			<?php endwhile ?>
		</div>
	</div>
</div>

<?php include 'isi/footer.php'; ?>
