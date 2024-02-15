<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Samudra Kue</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .navbar {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background-color: #FFFFFF;
        }
        .nav-item.dropdown .dropdown-item:active {
            background-color: #ECA400;
        }
        
        .navbar-collapse {
            background-color: #FFFFFF;
            margin-left: 10px;
        }
        
        .navbar-toggler {
            position: fixed;
            right: 15px; /* Atur sesuai kebutuhan jarak dari kiri */
            transform: translateX(0);
        }
        
        .footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background-color: #FFFFFF;
            border-top: 2px solid #558564;
            text-decoration: none;
            color: #252525;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column a {
            text-decoration: none;
            color: #243E36;
        }

        .container {
            padding-top: 0px;
            padding-bottom: 0px;
        }
        
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: auto;
        }
        
        .pagination a, .pagination span {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 2px;
            background-color: #ddd;
            color: #333;
            text-decoration: none;
        }
        
        .pagination a:hover {
            background-color: #F9F9F9;
            color: #252525;
        }
        
        .pagination .current {
            background-color: #558564;
            color: #fff;
            padding: 6px 11px;
            margin: 0 2px;
        }
        
        .pagination .disabled {
            background-color: #ddd;
            color: #999;
        }
    </style>
</head>

<body class="container-boxes" style="background-color: #FFFFFF;">
    @include('sweetalert::alert')
    
    <nav class="navbar navbar-expand-lg navbar-light mr-5" style="height: 70px">
        <div>
            <a class="navbar-brand mb-0 h1 ml-5" href="/">
                <img src="{{ asset('images/logo-fix.png') }}" alt="" width="40" height="25" class="d-inline-block align-top">
                Samudra Kue
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto mr-2">
                <li class="nav-item"><a class="nav-link" href="{{ url('about') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="/">Katalog</a></li>
                
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Masuk</a></li>
                    <li class="nav-item"><div class="card" style="background-color: #558564"><a class="nav-link" href="/register" style="color: #ffffff">Daftar</a></div></li>
                @endguest
                
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->username }}</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/cart">Keranjang Saya</a>
                            <a class="dropdown-item" href="/orders">Pesanan Saya</a>
                            <a class="dropdown-item" href="/addresses">Alamat Saya</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('container')
    </div>

    <footer class="footer pl-5 pt-3 mt-5">
        <div class="row m-auto">
            <div class="col-md-3">
                <a href="/about" class="footer" style="font-weight: bold"><p>Samudra Kue</p></a>
                <p style="font-size: 10pt"> Toko Samudra Kue, Jl. Hamara Efendi No.262, Hegarsari, Kec. Pataruman 46322, Kota Banjar, Jawa Barat, Indonesia</p>
            </div>
            <div class="col-md-2 footer-column">
                <ul>
                    <li><a href="/about" style="font-weight: bold">Tentang</a></li>
                    <li><a href="/contact" style="font-size: 10pt">Informasi Kontak</a></li>
                    <li><a href="/condition" style="font-size: 10pt">Ketentuan Penggunaan</a></li>
                    <li><a href="/policy" style="font-size: 10pt">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-column">
                <ul>
                    <li><a href="#" style="font-weight: bold">Temukan Kami</a></li>
                    <li><a href="#" style="font-size: 10pt">Facebook</a></li>
                    <li><a href="#" style="font-size: 10pt">Instagram</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>