@extends('layouts.main')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <title>Samudra Kue</title>
</head>

@section('container')
<body>
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <section>
                <div class="card border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title">Daftar</h2>
                        <p class="card-text">Mari mendaftar untuk melakukan pemesanan secara online!</p>
                    </div>
        
                    <div class="text-center">
                        <form action="/register" method="POST">
                            @csrf
        
                            <div class="form-group mb-2">
                                <label for="full_name" class="m-2">Nama Lengkap</label>
                                @error('full_name')
                                    <div>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <input type="text" class="form-control rounded-top @error('full_name') is-invalid @enderror" name="full_name" id="full_name" placeholder="Masukkan nama lengkap anda" required value="{{ old('full_name') }}">
                            </div>
        
                            <div class="form-group mb-2">
                                <label for="username" class="m-2">Username</label> <br>
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>                         
                                @enderror
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Minimal 1 karakter tanpa spasi" required value="{{ old('username') }}">
                            </div>
        
                            <div class="form-group mb-2">
                                <label for="phone_number" class="m-2">Nomor Telepon</label> <br>
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>                         
                                @enderror
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Format: +628xxxxxxxx" required value="{{ old('phone_number') }}">                        
                            </div>
        
                            <div class="form-group mb-2">
                                <label for="password" class="m-2">Password</label> <br>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>                         
                                @enderror
                                <input type="password" class="form-control rounded-bottom @error('password')
                                    is-invalid
                                @enderror" name="password" id="password" placeholder="Minimal 8 karakter" required>
                            </div>
        
                            <div>
                                <div class="form-group">
                                    <input class="form-control btn mt-3 text-white" type="submit" name="submit" id="submit" value="Register" style="background-color: #558564">
                                </div>
                                <div class="mt-3">
                                    <p>Sudah punya akun? <a href="/login">Masuk</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    @if(session('success'))
        <script>
            alert("{{session('success')}}");
        </script>
    @endif
</body>
@endsection