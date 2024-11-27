<?php
session_start();
require_once 'app/koneksi.php';

// Ambil nilai 'page' dari query string, jika tidak ada, set default ke 'dashboard'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';


// Mengambil data dari tabel `data`
$sql = "SELECT * FROM data";
$result = $conn->query($sql);

if (isset($_POST["btncari"])) {
    $result = cari($_POST["search"]);
    
}


?>


<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Concise HTML</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo-sm.svg">

        <!-- preloader css -->
        <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- other style -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Tambahkan ini di bagian <head> atau sebelum tag </body> -->
        

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="dashboard" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Concise HTML</span>
                                </span>
                            </a>

                            <a href="dashboard" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-sm.svg" alt="" height="24"> <span class="logo-txt">Concise HTML</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block" method="POST" action="">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." id="searchbar" name="search">
                                <button class="btn btn-primary" type="submit" id="btncari" name="btncari" onclick="window.location.href='dashboard'"><i class="bx bx-search-alt align-middle"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                       
                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>                      
                     

                        <div class="dropdown d-inline-block">
                           
                        </div>

                        

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            <li>
                                <a href="dashboard">
                                    <i data-feather="home"></i>
                                    <span data-key="t-dashboard">Dashboard</span>
                                </a>
                            </li>

                            

                            <li>
                                <a href="pendaftaran">
                                    <i data-feather="clipboard"></i>
                                    <span data-key="t-dashboard">Pendaftaran</span>
                                </a>
                            </li>
                          
                        </ul>                  
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

        <!-- start main content-->   
            <div class="main-content">

                <div class="page-content">

                    <div class="container-fluid">

                        <?php 
                            if ($page == 'dashboard') {
                                include 'views/dashboard.php';
                            }elseif ($page == 'pendaftaran') {
                                include 'views/pendaftaran.php';
                            }elseif ($page == 'update') {
                                include 'views/update.php';
                            }    
                        ?>
                    </div> 

                </div>

            </div>
         <!-- end main content-->

        
        <!-- Right Sidebar -->
        <?php include 'views/setting.html';?>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

    <script>
        function previewFoto(event) {
            const output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.style.display = 'block';
        }
        function clearForm() {
            document.getElementById("registrationForm").reset(); // Mengatur ulang semua input dalam form
        }
    </script>

        <!-- JAVASCRIPT -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>
        <script src="assets/js/waves.min.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <!-- pace js -->
        <script src="assets/js/pace.min.js"></script>

        <script src="assets/js/app.js"></script>
        <script src="assets/js/nika.js"></script>
        <script src="assets/js/ajax.js"></script>
 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>


<?php 
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'success') {
            echo "<script>
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil disimpan',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>";
        } elseif ($_SESSION['status'] == 'deleted') {
            echo "<script>
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil dihapus',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>";
        }
        elseif ($_SESSION['status'] == 'update') {
            echo "<script>
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data berhasil diupdate',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>";
        }
    unset($_SESSION['status']); // Hapus session setelah menampilkan alert
    }
?>