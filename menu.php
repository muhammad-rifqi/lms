  <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">LMS <sup> V-1</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="diskusi.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

			<?php 
				if($_SESSION['access'] == 'admin'){
			?>
			<li class="nav-item">
                <a class="nav-link" href="?menu=diskusi">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Diskusi</span></a>
            </li>
			<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Kelas</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Module Kelas:</h6>
                        <a class="collapse-item" href="?menu=kelas"> Kelas </a>
                    </div>
                </div>
			</li>
			<li class="nav-item">
                <a class="nav-link" href="?menu=pengguna">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Pengguna</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="?menu=laporan">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Nilai</span></a>
            </li>
			<?php 
			} if($_SESSION['access'] == 'guru' || $_SESSION['access'] == 'siswa'){
			?>
			
							<li class="nav-item">
                <a class="nav-link" href="?menu=diskusi">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Diskusi</span></a>
            </li>
			<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Kelas</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Module Kelas:</h6>
                        <a class="collapse-item" href="?menu=kelas"> Kelas </a>
                    </div>
                </div>
			</li>
			<li class="nav-item">
                <a class="nav-link" href="?menu=laporan">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Nilai</span></a>
            </li>
			
			
			<?php } ?>
			
            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
            </div>

        </ul>