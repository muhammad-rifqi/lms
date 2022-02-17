<?php
error_reporting(0);
session_start();
include "config/config.php";
$id = session_id();

$sql = mysqli_query($koneksi,"select * from user where email = '".$_POST['email']."' and password='".md5($_POST['password'])."'");
$data = mysqli_fetch_array($sql);
$cek = mysqli_num_rows($sql);

if($cek > 0) {
	$_SESSION['id_user'] = $data['id_user'];
	$_SESSION['email'] = $data['email'];
	$_SESSION['full_name'] = $data['full_name'];
	$_SESSION['access'] = $data['access'];	
	header('location:diskusi.php');
}else{
	echo "<script>alert('Login Gagal'); window.location='index.php';</script>";
}

?>