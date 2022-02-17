<?php
include "config/config.php";
if($_GET['act'] == 'ubah'){

$sql = mysqli_query($koneksi,"select * from user where email = '".$_POST['email']."'");
$data = mysqli_fetch_array($sql);
$cek = mysqli_num_rows($sql);
if($cek > 0) {
	$params = htmlentities($data['email']);
	header('location:ubah_password.php?email='.urlencode($params));
}else{
	echo "<script>alert('Email Tidak Ada'); window.location='register.php';</script>";
}

}if($_GET['act'] == 'ganti'){

$sql = mysqli_query($koneksi,"update user set password = '".md5($_POST['password_baru'])."' where email = '".$_POST['email']."'");
if($sql){
	echo "<script>alert('Success Ganti Password '); window.location='index.php';</script>";
}else{
	echo "<script>alert('Silahkan Buat Akun Baru'); window.location='register.php';</script>";
}
}
?>