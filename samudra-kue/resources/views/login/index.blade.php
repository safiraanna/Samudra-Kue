@extends('layouts.main')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Samudra Kue</title>
</head>

@section('container')
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
    
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
    
                <section>
                    <div class="card border-0">
                        <div class="card-body text-center">
                            <h2 class="card-title">Masuk</h2>
                            <p class="card-text">Masuk ke akunmu untuk melakukan pemesanan melalui web</p>
                        </div>
    
                        <div class="text-center">
                            <form action="/login" method="POST">
                                @csrf
    
                                <div class="form-group mb-2">
                                    <label for="username" class="m-2">Username</label>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" required value="{{ old('username') }}">
                                </div>
    
                                <div class="form-group mb-2">
                                    <label for="password" class="m-2">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>                         
                                    @enderror
                                    <input type="password" name="password" class=" form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required ">                        
                                </div>
    
                                <div>
                                    <div class="form-group">
                                        <input class="form-control mt-5 text-white" type="submit" name="submit" id="submit" value="Masuk" style="background-color: #7CA982">
                                    </div>
                                    <div class="mt-3">
                                        <p>Belum Punya Akun? <a href="/register">Buat Akun Sekarang!</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
@endsection