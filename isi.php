<?php
if($_GET['menu'] == ''){
echo "
<h3><b> Selamat Datang $_SESSION[full_name] </b></h3> ";   
}if($_GET['menu'] == 'diskusi'){
$sql = mysqli_query($koneksi,"select * from diskusi");
?>

<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Diskusi </h1>
    </div>
</div>

<div class="col-md-8 offset-2">
    <div class="card mb-8">
        <div class="card-header text-white bg-primary">
            Mulai Diskusi Baru
        </div>
        <div class="card-body">
            <div class="well">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                    action="aksi.php?act=insert_diskusi">
                    <div class="form-group" style="padding:5px;">
                        <textarea class="form-control" name="keterangan"
                            placeholder="Silahkan Mulai Diskusi"></textarea>
                        <input type="file" name="file">
                    </div>
                    <button class="btn btn-primary pull-right" type="subnit">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
while($data = mysqli_fetch_array($sql)){
$gambar = empty($data['file']) ? "" : "<img src='assets/upload/diskusi/".$data['file']."' width='100%'>";
?>
<div class="col-md-8 offset-2" style="margin-top:20px">
    <div class="card mb-8">
        <div class="card-header text-white bg-primary">
            Diskusi oleh : <?php echo $data['user_update'].' tanggal : '.$data['tanggal_update'];?>
        </div>
        <div class="card-body">
            <div class="well">
                <p><?php echo $gambar; ?></p>
                <p> <b> <?php echo $data['keterangan'];?> </b> </p>
                <form class="form-horizontal" role="form" method="POST" action="aksi.php?act=insert_komentar">
                    <input type="hidden" name="id_diskusi" value="<?php echo $data['id_diskusi']; ?>">
                    <div class="form-group" style="padding:5px;">
                        <textarea class="form-control" name="komentar" placeholder="Silahkan Mulai Komentar"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Balas</button>
                </form>
                <br>
                <?php
			$sql2 = mysqli_query($koneksi,"select * from komentar where id_diskusi = '".$data['id_diskusi']."'");
			while($data2 = mysqli_fetch_array($sql2)){
				echo "<p> <b> $data2[user_update] </b> berkata ( $data2[komentar] ) Pada Tanggal ( $data2[tanggal_update] ) </p>";
			}
		  ?>

            </div>
        </div>
    </div>
</div>
<?php
}
}if($_GET['menu'] == 'edit_profile'){
?>

<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Profile </h1>
    </div>
</div>

<div class="col-md-8 offset-2">
    <div class="card mb-8">
        <div class="card-header text-white bg-primary">
            Edit Profile
        </div>
        <div class="card-body">
            <div class="well">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                    action="aksi.php?act=update_profile">
                    <div class="form-group" style="padding:5px;">
                        <input class="form-control" name="full_name" placeholder="Silahkan Update Fullname">
                    </div>
                    <button class="btn btn-primary pull-right" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
}if($_GET['menu'] == 'pengguna'){
?>
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Pengguna </h1>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Fullname</th>
                        <th>Akses</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Fullname</th>
                        <th>Akses</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
					$sql = mysqli_query($koneksi,"select * from user"); 
					while($data = mysqli_fetch_array($sql)){
					?>
                    <tr>
                        <td><?php echo $data['id_user'];?></td>
                        <td><?php echo $data['email'];?></td>
                        <td><?php echo $data['password'];?></td>
                        <td><?php echo $data['full_name'];?></td>
                        <td><?php echo $data['access'];?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
}if($_GET['menu'] == 'kelas'){ 
if($_SESSION['access'] == 'admin'){
?>
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Kelas </h1>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="?menu=tambah_kelas" class="btn btn-primary">Tambah Kelas</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Guru</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Guru</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
					$sql = mysqli_query($koneksi,"select * from kelas"); 
					while($data = mysqli_fetch_array($sql)){
					?>
                    <tr>
                        <td><?php echo $data['id'];?></td>
                        <td><?php echo $data['nama_kelas'];?></td>
                        <td><?php echo $data['guru'];?></td>
                        <td><a
                                href="assets/upload/materi/<?php echo $data['materi'];?>"><?php echo $data['materi'];?></a>
                        </td>
                        <td><a href="aksi.php?act=hapus_kelas&id=<?php echo $data['id'];?>&file=<?php echo $data['materi'];?>"
                                class="btn btn-danger" onclick="return confirm('Yakin Mau Hapus ??')">Hapus</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php 
}if($_SESSION['access'] == 'guru'){
?>

<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Kelas </h1>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="h3 mb-0 text-gray-800"> Kelas</h1>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Guru</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Guru</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
					$sql = mysqli_query($koneksi,"select * from kelas where guru = '".$_SESSION['full_name']."'"); 
					while($data = mysqli_fetch_array($sql)){
					?>
                    <tr>
                        <td><?php echo $data['id'];?></td>
                        <td><?php echo $data['nama_kelas'];?></td>
                        <td><?php echo $data['guru'];?></td>
                        <td><a
                                href="assets/upload/materi/<?php echo $data['materi'];?>"><?php echo $data['materi'];?></a>
                        </td>
                        <td><a href="?menu=detail_kelas&id=<?php echo $data['id'];?>" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php
}if($_SESSION['access'] == 'siswa'){
?>

<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Kelas </h1>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="h3 mb-0 text-gray-800"> Kelas</h1>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Guru</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Guru</th>
                        <th>Materi</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
					$sql = mysqli_query($koneksi,"select * from kelas"); 
					while($data = mysqli_fetch_array($sql)){
					?>
                    <tr>
                        <td><?php echo $data['id'];?></td>
                        <td><?php echo $data['nama_kelas'];?></td>
                        <td><?php echo $data['guru'];?></td>
                        <td><a
                                href="assets/upload/materi/<?php echo $data['materi'];?>"><?php echo $data['materi'];?></a>
                        </td>
                        <td>
                            <a href="?menu=join_kelas&id=<?php echo $data['id'];?>" class="btn btn-success">Join
                                Kelas</a>
                            <a href="?menu=detail_kelas&id=<?php echo $data['id'];?>" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
}} if($_GET['menu'] == 'tambah_kelas'){ ?>
<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Tambah Kelas </h1>
    </div>
</div>

<div class="col-md-8 offset-2">
    <div class="card mb-8">
        <div class="card-header text-white bg-primary">
            Tambah Kelas
        </div>
        <div class="card-body">
            <div class="well">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                    action="aksi.php?act=insert_kelas">
                    <div class="form-group" style="padding:5px;">
                        <input class="form-control" name="nama_kelas" placeholder="Silahkan Masukan Nama Kelas">
                    </div>
                    <div class="form-group" style="padding:5px;">
                        <select class="form-control" name="guru">
                            <option value="--">Pilih Guru</option>
                            <?php 
				$sql = mysqli_query($koneksi,"select * from user where access = 'guru'");
				while($data = mysqli_fetch_array($sql)){
					echo "<option value='".$data['full_name']."'>".$data['full_name']."</option>";
				}
				?>
                        </select>
                    </div>
                    <div class="form-group" style="padding:5px;">
                        <input class="form-control" type="file" name="file">
                    </div>
                    <button class="btn btn-primary pull-right" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}if($_GET['menu'] == 'detail_kelas'){
if($_SESSION['access'] == 'guru' || $_SESSION['access'] == 'admin'){ 
$sql = mysqli_query($koneksi,"select * from kelas where id = '".$_GET['id']."'");
$data = mysqli_fetch_array($sql);
?>


<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Detail Kelas <?php echo $data['nama_kelas']; ?> </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div style="padding-left:15px">
            <h6>ID KELAS : <?php echo $data['id']; ?></h6>
            <h6>GURU : <?php echo $data['guru']; ?></h6>
            <h6>MATERI : <a
                    href="assets/upload/materi/<?php echo $data['materi']; ?>"><?php echo $data['materi']; ?></a></h6>
            <br>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-12">
            <div class="card-header text-white bg-primary">
                Siswa Yang Bergabung
            </div>
            <div class="card-body">
                <div class="well">

				<div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID Kelas</th>
                                            <th>Full Name</th>
                                            <th>Jawaban</th>
                                            <th>Nilai</th>
											<th>Ubah</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID Kelas</th>
                                            <th>Full Name</th>
                                            <th>Jawaban</th>
                                            <th>Nilai</th>
											<th>Ubah</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
								$sql3 = mysqli_query($koneksi,"select * from siswa_kelas where id_kelas = '".$_GET['id']."'"); 
								while($data3 = mysqli_fetch_array($sql3)){
								?>
                                        <tr>
                                            <td><?php echo $data3['id'];?></td>
                                            <td><?php echo $data3['id_kelas'];?></td>
                                            <td><?php echo $data3['full_name'];?></td>
                                            <td><a href="assets/upload/tugas/siswa/<?php echo $data3['berkas'];?>"
                                                    target="__blank"><?php echo $data3['berkas'];?></a></td>
                                            <td><?php echo $data3['nilai'];?></td>
											<td><a class="btn btn-warning" href="?menu=ubah_nilai&id=<?php echo $data3['id']; ?>">Ubah Nilai</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-12">
            <div class="card-header text-white bg-primary">
                Tugas
            </div>
            <div class="card-body">
                <div class="well">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Kelas</th>
                                            <th>Berkas</th>
                                            <th>Tanggal</th>
                                            <th>Id Kelas</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Kelas</th>
                                            <th>Berkas</th>
                                            <th>Tanggal</th>
                                            <th>Id Kelas</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
								$sql2 = mysqli_query($koneksi,"select * from tugas where id_kelas = '".$_GET['id']."'"); 
								while($data2 = mysqli_fetch_array($sql2)){
								?>
                                        <tr>
                                            <td><?php echo $data2['id'];?></td>
                                            <td><?php echo $data2['nama_kelas'];?></td>
                                            <td><a href="assets/upload/tugas/guru/<?php echo $data2['berkas'];?>"
                                                    target="__blank"><?php echo $data2['berkas'];?></a></td>
                                            <td><?php echo $data2['tanggal_update'];?></td>
                                            <td><?php echo $data2['id_kelas'];?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="card-body">
                        <div class="well">
                            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                                action="aksi.php?act=insert_tugas">
                                <input type="hidden" name="id_kelas" value="<?php echo $_GET['id']?>">
                                <input type="hidden" name="nama_kelas" value="<?php echo $data['nama_kelas']?>">
                                <div class="form-group" style="padding:5px;">
                                    <h5>Upload Berkas</h5>
                                    <input class="form-control" name="file" type="file"
                                        style="width:50%; float:left">&nbsp;&nbsp;
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
$sql = mysqli_query($koneksi,"select * from kelas where id = '".$_GET['id']."'");
$data = mysqli_fetch_array($sql);
?>

<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Detail Kelas <?php echo $data['nama_kelas']; ?> </h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div style="padding-left:15px">
            <h6>ID KELAS : <?php echo $data['id']; ?></h6>
            <h6>GURU : <?php echo $data['guru']; ?></h6>
            <h6>MATERI : <a
                    href="assets/upload/materi/<?php echo $data['materi']; ?>"><?php echo $data['materi']; ?></a></h6>
            <br>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-12">
            <div class="card-header text-white bg-primary">
                Siswa Yang Bergabung
            </div>
            <div class="card-body">
                <div class="well">

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID Kelas</th>
                                            <th>Full Name</th>
                                            <th>Jawaban</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>ID Kelas</th>
                                            <th>Full Name</th>
                                            <th>Jawaban</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
								$sql2 = mysqli_query($koneksi,"select * from siswa_kelas where id_kelas = '".$_GET['id']."'"); 
								while($data2 = mysqli_fetch_array($sql2)){
								?>
                                        <tr>
                                            <td><?php echo $data2['id'];?></td>
                                            <td><?php echo $data2['id_kelas'];?></td>
                                            <td><?php echo $data2['full_name'];?></td>
                                            <td><a href="assets/upload/tugas/siswa/<?php echo $data2['berkas'];?>"
                                                    target="__blank"><?php echo $data2['berkas'];?></a></td>
                                            <td><?php echo $data2['nilai'];?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-12">
            <div class="card-header text-white bg-primary">
                Tugas
            </div>
            <div class="card-body">
                <div class="well">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Kelas</th>
                                            <th>Berkas</th>
                                            <th>Tanggal</th>
                                            <th>Id Kelas</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Kelas</th>
                                            <th>Berkas</th>
                                            <th>Tanggal</th>
                                            <th>Id Kelas</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
								$sql2 = mysqli_query($koneksi,"select * from tugas where id_kelas = '".$_GET['id']."'"); 
								while($data2 = mysqli_fetch_array($sql2)){
								?>
                                        <tr>
                                            <td><?php echo $data2['id'];?></td>
                                            <td><?php echo $data2['nama_kelas'];?></td>
                                            <td><a href="assets/upload/tugas/guru/<?php echo $data2['berkas'];?>"
                                                    target="__blank"><?php echo $data2['berkas'];?></a></td>
                                            <td><?php echo $data2['tanggal_update'];?></td>
                                            <td><?php echo $data2['id_kelas'];?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="card-body">
                        <div class="well">
                            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                                action="aksi.php?act=update_tugas">
                                <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']?>">
								<input type="hidden" name="id_kelas" value="<?php echo $_GET['id']?>">
                                <div class="form-group" style="padding:5px;">
                                    <h5>Upload Jawaban</h5>
                                    <input class="form-control" name="file" type="file"
                                        style="width:60%; float:left" required>&nbsp;&nbsp;
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>




<?php
}
}if($_GET['menu'] == 'join_kelas'){ 
$sql = mysqli_query($koneksi,"select * from kelas where id = '".$_GET['id']."'");
$data = mysqli_fetch_array($sql);
?>

<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Gabung kelas <?php echo $data['nama_kelas']; ?> </h1>
    </div>
</div>

<div class="col-md-8 offset-2">
    <div class="card mb-8">
        <div class="card-header text-white bg-primary">
            Gabung Kelas
        </div>
        <div class="card-body">
            <div class="well">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                    action="aksi.php?act=join_kelas">
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                    <input type="hidden" name="id_kelas" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="full_name" value="<?php echo $_SESSION['full_name']; ?>">
                    <div class="form-group" style="padding:5px;">
                        <input class="form-control" name="id_kelas" value="<?php echo $data['id']; ?>"
                            placeholder="Silahkan Update Fullname">
                    </div>
                    <button class="btn btn-warning pull-right" type="submit">Join</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php }if($_GET['menu'] == 'laporan'){ ?>

	<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Pilih Kelas </h1>
    </div>
</div>

<div class="col-md-8 offset-2">
    <div class="card mb-8">
        <div class="card-header text-white bg-primary">
            Pilih Kelas
        </div>
        <div class="card-body">
            <div class="well">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                    action="?menu=view_nilai">
                    <div class="form-group" style="padding:5px;">
                        <select class="form-control" name="kelas">
							<option value="--">Pilih Kelas</option>
							<?php
								$sql = mysqli_query($koneksi,"select * from kelas");
								while($data=mysqli_fetch_array($sql)){
									echo '<option value="'.$data['id'].'">'.$data['nama_kelas'].'</option>';
								}
							?>
						</select>
                    </div>
                    <button class="btn btn-primary pull-right" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
}if($_GET['menu'] =='view_nilai'){
?>

<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> View Nilai </h1>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        View Nilai
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Kelas</th>
                        <th>Full Name</th>
                        <th>Berkas</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
						<th>ID</th>
                        <th>ID Kelas</th>
                        <th>Full Name</th>
                        <th>Berkas</th>
                        <th>Nilai</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php 
					$sql = mysqli_query($koneksi,"select * from siswa_kelas"); 
					while($data = mysqli_fetch_array($sql)){
					?>
                    <tr>
                        <td><?php echo $data['id'];?></td>
                        <td><?php echo $data['id_kelas'];?></td>
                        <td><?php echo $data['full_name'];?></td>
                        <td><a
                                href="assets/upload/tugas/siswa/<?php echo $data['berkas'];?>"><?php echo $data['berkas'];?></a>
                        </td>
                        <td><?php echo $data['nilai']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php
}if($_GET['menu'] == 'ubah_nilai'){
$sql = mysqli_query($koneksi,"select * from siswa_kelas where id = '".$_GET['id']."'");
$data= mysqli_fetch_array($sql);
?>


<div class="col-md-12">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> Ubah Nilai </h1>
    </div>
</div>

<div class="col-md-8 offset-2">
    <div class="card mb-8">
        <div class="card-header text-white bg-primary">
            Ubah Nilai
        </div>
        <div class="card-body">
            <div class="well">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                    action="aksi.php?act=update_nilai">
					<input type="hidden" name="id" value="<?php echo $data['id'];?>">
					<input type="hidden" name="id_kelas" value="<?php echo $data['id_kelas'];?>">
                    <div class="form-group" style="padding:5px;">
                        <input class="form-control" name="nilai" placeholder="Silahkan Update Nilai">
                    </div>
                    <button class="btn btn-primary pull-right" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
}
?>