<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <style>
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 280px; 
            background-color: #30343f;
            z-index: 1;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 20px; /* Atur padding atas sesuai kebutuhan */
        }

        .container {
            margin-left: 145px; /* Sesuaikan dengan lebar sidebar */
            padding: 15px; /* Atur padding sesuai kebutuhan */
        }

        @media (max-width: 768px) {
            #sidebar {
                width: 0;
            }

            .container {
                margin-left: 0; /* Untuk layar kecil, atur margin kembali ke 0 */
            }
        }

        .logout-item {
            position: absolute;
            bottom: 20px; /* Atur jarak ke bawah sesuai kebutuhan */
        }

        .toggle-button {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 2;
            cursor: pointer;
        }
    </style>

    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 280px">
                    <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <h5 class="fs-4 ml-3 mt-5">Halo Administrator</h5>
                    </div>

                    <hr>

                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link text-white" aria-current="page">
                                <i class="bi bi-house-door"></i> Overview
                            </a>
                        </li>
                        <li>
                            <a href="#pesananSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link text-white">
                                <i class="bi bi-cart"></i> Pesanan
                            </a>
                            <ul class="collapse list-unstyled" id="pesananSubmenu">
                                <li><a href="/admin/order" class="nav-link text-white">Dalam Proses</a></li>
                                <li><a href="/admin/history" class="nav-link text-white">Selesai</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/admin/users" class="nav-link text-white">
                                <i class="bi bi-person"></i> Pengguna
                            </a>
                        </li>
                        <li>
                            <a href="#produkSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link text-white">
                                <i class="bi bi-box"></i> Kelola Produk
                            </a>
                            <ul class="collapse list-unstyled" id="produkSubmenu">
                                <li><a href="/admin/products" class="nav-link text-white">Katalog Produk</a></li>
                                <li><a href="/admin/products/create" class="nav-link text-white">Tambah Produk</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/sales-report" class="nav-link text-white">
                                <i class="bi bi-files"></i> Laporan
                            </a>
                        </li>
                        <li class="logout-item">
                            <a href="/logout" class="nav-link text-white">
                                <i class="bi bi-power"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    
    <!-- Tombol "Toggle Sidebar" -->
    <div class="toggle-button" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </div>
    
    <script>
        // Fungsi untuk menampilkan/menyembunyikan sidebar
        function toggleSidebar() {
            var sidebar = document.getElementById("sidebar");
            if (sidebar.style.width === "280px") {
                sidebar.style.width = "0";
            } else {
                sidebar.style.width = "280px";
            }
        }
    </script>
</body>
</html>