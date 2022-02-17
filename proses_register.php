<?php
include "config/config.php";
$sql= mysqli_query($koneksi,"insert into user(email,password,full_name,access)values('".$_POST['email']."','".md5($_POST['password'])."','".$_POST['full_name']."','".$_POST['access']."')");
if($sql){
	echo "<script>alert('success, silahkan untuk login');window.location='register.php';</script>"; 
}else{
	echo "<script>alert('failed');window.location='register.php';</script>";
}
?>