<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Samudra Kue</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .navbar {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background-color: #7CA982;
        }
        .nav-item.dropdown .dropdown-item:active {
            background-color: #7CA982;
            color: #FFFFFF;
        }

        .footer {
            position: relative;
            bottom: 0;
            width: 100%;
            background-color: #FFFFFF;
            border-top: 2px solid #7CA982;
            text-decoration: none;
            color: #243E36;
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
    </style>
</head>

<body class="container-boxes" style="background-color: #FFFFFF;">
    @include('sweetalert::alert')
    
    <nav class="navbar navbar-expand-lg navbar-light" style="height: 70px">
        <div>
            <a class="navbar-brand mb-0 h1 ml-5 text-white" href="/">
                <img src="{{ asset('images/logo-fix.png') }}" alt="" width="40" height="25" class="d-inline-block align-top">
                Samudra Kue
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav" style="background-color: #7CA982">
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('about') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/">Katalog</a></li>
                @guest
                    <li class="nav-item"><a class="nav-link text-white" href="{{ url('login') }}">Masuk</a></li>
                    <li class="nav-item"><div class="card" style="background-color: #E0EEC6"><a class="nav-link" href="/register" style="color: #243E36">Daftar</a></div></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->username }}</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/cart">Keranjang Saya</a>
                            <a class="dropdown-item" href="/orders">Pesanan Saya</a>
                            <a class="dropdown-item" href="/addresses">Alamat Saya</a>
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </div>
                    </li>
                @endguest
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