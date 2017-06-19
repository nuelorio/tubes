<?php
	require_once('../../init.php');
	$id 		= $_POST['id'];
	$id 		= (int)$id;
	$sql		= "SELECT * FROM list_kos WHERE id = '$id'";
	$result 	= $db->query($sql);
	$list_kos	= mysqli_fetch_assoc($result);
?>

<?ob_start();?>
<div class="modal fade details" id="details-modal" role="dialog" aria-labelledby="details" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" onclick="closeModal()" type="button" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title text-center"><b><?= $list_kos['nama_kos'] ?></b></h3>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="center-block">
								<img src= "<?= $list_kos['gambar'] ?>" alt="Jika anda melihat tulisan ini maka ada masalah pada database ketika menampilkan gambar" class="details img-responsive">
							</div>
						</div>
						<div class="col-sm-6">
							<h4><b>Rincian:</b></h4>
							<b>Harga:</b><p class="price"> Rp <?= number_format($list_kos['harga'],2)."/tahun"; ?></p>
							<b>Lokasi:</b><p><?= $list_kos['lokasi'] ?> </p>
							<p id="icon-fasilitas"><b>Fasilitas:</b><br>
							<?php
							$nama 		= mysqli_real_escape_string($db,$list_kos['nama_kos']);
							$sql2		= "SELECT * FROM fasilitas WHERE nama_kos = '$nama'";
							$fresult	= $db->query($sql2);
							$eFasilitas = mysqli_fetch_assoc($fresult);
							?>
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
							</p>
							<b>Kategori:</b>
							<p>
								<?php 
								if($list_kos['kategori']==1){
									echo "Kost Laki-laki";
								}else if($list_kos['kategori']==2){
									echo "Kost Perempuan";
								}else if($list_kos['kategori']==3){
									echo "Kost Campuran";
								}else{
									echo "Kost tak Berkategori";
								}
								?>

							</p>
							<b>Deskripsi:</b><p><?= $list_kos['deskripsi']?></p>
							<b>Untuk informasi lebih lanjut dapat menghubungi nomor:</b> 
							<p>
								<?php 
									$namauser 	= mysqli_real_escape_string($db,$list_kos['username']);
									$sql3	= "SELECT * FROM pengguna WHERE username = '$namauser'";
									$result3= $db->query($sql3);
									$ePengguna	= mysqli_fetch_assoc($result3);
									echo $ePengguna['no_hp']." a/n ".$ePengguna['username'];
								?>
							</p>
							
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn button-default" onclick="closeModal()" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<?php echo ob_get_clean(); ?>
