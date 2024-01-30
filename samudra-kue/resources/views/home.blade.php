@extends('layouts.main')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Samudra Kue</title>

    <style>
        .custom-card {
            width: 12rem;
            height: 100%; 
        }

        .custom-card .card-title {
            font-size: 16px;
            color: #001A23
        }
    </style>
</head>

@section('container')
<body>
    <!-- Banner Informasi -->
    <div class="container-fluid banner-container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Satu Tempat untuk Semua Jenis Kebutuhan Makanan Ringan!</h1>
                <p>Berlimpah Varian, Ketersediaan Penuh! Grosir Snack Pilihanmu.</p>
            </div>
        </div>
    </div>

    <section>
        <div class="container text-center mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="mb-4">Cari Produk</h3>
                    <form>
                        <div class="form-group d-flex">
                            <input type="search" class="form-control form-control-lg mr-2" placeholder="Cari disini..." name="search" value="{{ request('search') }}" aria-label="Search">
                            <button class="btn btn-lg" type="submit" id="btnTemp">Cari</button>
                        </div>
                    </form>
                    @if($isEmptySearch)
                        <p>Tidak ada produk yang sesuai dengan kata kunci tersebut</p>
                    @endif
                </div>
            </div> 
        </div>
        
        <div class="row text-center">
            @foreach ($products as $product)
            <div class="col-md-2 col-sm-6 mt-5">
                <div class="card custom-card mb-3">
                    <a href="{{url(sprintf('product/%s', $product->id)) }}" class="text-decoration-none"> {{-- sprintf itu pemformatan string, untuk menggabungkan product/ dengan product->id --}}
                        @if($product->stocks == 0) 
                            <img src="{{ asset('storage/soldout.png') }}" style="height: 12rem">
                            <div class="card-body">
                                <h3 class="card-title" class="text-decoration-none fs-3">{{$product->product_name}}</h3>
                            </div>
                        @else
                            @if($product->images->isNotEmpty())
                                <img src="{{ asset('storage/product_images/' . $product->images[0]->picture_name) }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 12rem">
                            @else
                                <img src="https://source.unsplash.com/1000x500/?snack" alt="snack" class="card-img-top">
                            @endif
                            <div class="card-body">
                                <h3 class="card-title" class="text-decoration-none fs-3">{{$product->product_name}}</h3>
                            </div>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Paginasi Kustom -->
        @include('layouts.pagination', ['paginator' => $products])
    </section>
</body>
@endsection