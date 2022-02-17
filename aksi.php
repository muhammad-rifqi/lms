<?php
session_start();
include"config/config.php";

if($_GET['act'] == 'insert_diskusi'){

$tgl = date('Y-m-d H:i:s');
$full_name = $_SESSION['full_name'];
$lokasi_file = $_FILES['file']['tmp_name'];
$nama_file = $_FILES['file']['name'];

if(!empty($lokasi_file)){
	move_uploaded_file($lokasi_file,"assets/upload/diskusi/$nama_file");
	mysqli_query($koneksi,"insert into diskusi(id_diskusi,file,keterangan,tanggal_update,user_update)values('".$_POST['id_diskusi']."','".$nama_file."','".$_POST['keterangan']."','".$tgl."','".$full_name."')");
}else{
	mysqli_query($koneksi,"insert into diskusi(id_diskusi,file,keterangan,tanggal_update,user_update)values('".$_POST['id_diskusi']."','".$nama_file."','".$_POST['keterangan']."','".$tgl."','".$full_name."')");
}
	header('location:diskusi.php?menu=diskusi');
}

if($_GET['act'] == 'insert_komentar'){
	$tgl = date('Y-m-d H:i:s');
	$full_name = $_SESSION['full_name'];
	mysqli_query($koneksi,"insert into komentar(id_diskusi,komentar,tanggal_update,user_update)values('".$_POST['id_diskusi']."','".$_POST['komentar']."','".$tgl."','".$full_name."')");
	header('location:diskusi.php?menu=diskusi');
}



if($_GET['act'] == 'insert_kelas'){

$lokasi_file = $_FILES['file']['tmp_name'];
$nama_file = strtolower(str_replace(" ","",$_FILES['file']['name']));

if(!empty($lokasi_file)){
	move_uploaded_file($lokasi_file,"assets/upload/materi/$nama_file");
	mysqli_query($koneksi,"insert into kelas(id,nama_kelas,guru,materi)values('".$_POST['id']."','".$_POST['nama_kelas']."','".$_POST['guru']."','".$nama_file."')");
}else{
	mysqli_query($koneksi,"insert into kelas(id,nama_kelas,guru,materi)values('".$_POST['id']."','".$_POST['nama_kelas']."','".$_POST['guru']."')");
}
	header('location:diskusi.php?menu=kelas');
}

if($_GET['act'] == 'hapus_kelas'){

if(file_exists('assets/upload/materi/'.$_GET['file'].'')){
	unlink('assets/upload/materi/'.$_GET['file'].'');
	mysqli_query($koneksi,"delete from kelas where id = '".$_GET['id']."'");
}else{
	mysqli_query($koneksi,"delete from kelas where id = '".$_GET['id']."'");
}
	header('location:diskusi.php?menu=kelas');
}


if($_GET['act'] == 'insert_tugas'){
$tgl = date('Y-m-d H:i:s');
$lokasi_file = $_FILES['file']['tmp_name'];
$nama_file = strtolower(str_replace(" ","",$_FILES['file']['name']));

if(!empty($lokasi_file)){
	move_uploaded_file($lokasi_file,"assets/upload/tugas/guru/$nama_file");
	mysqli_query($koneksi,"insert into tugas(id,nama_kelas,berkas,tanggal_update,id_kelas)values('".$_POST['id']."','".$_POST['nama_kelas']."','".$nama_file."','".$tgl."','".$_POST['id_kelas']."')");
}else{
	mysqli_query($koneksi,"insert into tugas(id,nama_kelas,tanggal_update,id_kelas)values('".$_POST['id']."','".$_POST['nama_kelas']."','".$tgl."','".$_POST['id_kelas']."')");
}
	header('location:diskusi.php?menu=detail_kelas&id='.$_POST['id_kelas'].'');
}


if($_GET['act'] == 'join_kelas'){
	$sql = mysqli_query($koneksi,"select * from siswa_kelas where id_user = '".$_SESSION['id_user']."' and id_kelas='".$_POST['id_kelas']."' ");
	$jumlah = mysqli_num_rows($sql);
	if($jumlah > 0 ){
		echo "<script>alert('Anda Sudah Join Di Kelas Ini, Silahkan Join Kembali');window.location='diskusi.php?menu=kelas';</script>";
	}else{
		mysqli_query($koneksi,"insert into siswa_kelas(id_user,id_kelas,full_name)values('".$_POST['id_user']."','".$_POST['id_kelas']."','".$_POST['full_name']."')");
		echo "<script>alert('Join SUCCESS');window.location='diskusi.php?menu=kelas';</script>";
	}

}


if($_GET['act'] == 'update_tugas'){
	$lokasi_file = $_FILES['file']['tmp_name'];
	$nama_file = strtolower(str_replace(" ","",$_FILES['file']['name']));
	if(!empty($lokasi_file)){
		move_uploaded_file($lokasi_file,"assets/upload/tugas/siswa/$nama_file");
		mysqli_query($koneksi,"update siswa_kelas set berkas = '".$nama_file."' where id_user = '".$_POST['id_user']."'");
	}
		header('location:diskusi.php?menu=detail_kelas&id='.$_POST['id_kelas'].'');
	}
	

	if($_GET['act'] == 'update_nilai'){
		mysqli_query($koneksi,"update siswa_kelas set nilai = '".$_POST['nilai']."' where id = '".$_POST['id']."'");
		header('location:diskusi.php?menu=detail_kelas&id='.$_POST['id_kelas'].'');
	}

?>