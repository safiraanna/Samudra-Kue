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
    <section>
        <div class="container text-center mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="mb-4" style="color: #001A23">Cari Produk</h3>
                    <form>
                        <div class="form-group d-flex">
                            <input type="search" class="form-control form-control-lg mr-2" placeholder="Cari disini..." name="search" value="{{ request('search') }}" aria-label="Search">
                            <button class="btn btn-lg text-white" type="submit" style="background-color: #7CA982">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="row text-center">
            @foreach ($products as $product)
            <div class="col-md-2 col-sm-6 mt-5">
                <div class="card custom-card mb-3">
                    <a href="{{url(sprintf('product/%s', $product->id)) }}" class="text-decoration-none">
                        @if($product->images->isNotEmpty())
                            <img src="{{ asset('storage/product_images/' . $product->images[0]->picture_name) }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 12rem">
                        @else
                            <img src="https://source.unsplash.com/1000x500/?snack" alt="snack" class="card-img-top">
                        @endif

                        {{-- <img src="{{ asset('storage/product_images/' . $product->images[0]->picture_name) }}" class="card-img-top" alt="{{ $product->product_name }}" style="height: 12rem"> --}}
                        <div class="card-body">
                            <h3 class="card-title" class="text-decoration-none fs-3">{{$product->product_name}}</h3>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            @if ($products->previousPageUrl())
                <a href="{{ $products->previousPageUrl() }}" class="btn text-white" style="background-color: #7CA982" rel="prev">&lt; Sebelumnya</a>
            @endif
                
            @if ($products->nextPageUrl())
                <a href="{{ $products->nextPageUrl() }}" class="btn ml-3 text-white" style="background-color: #7CA982" rel="next">Selanjutnya &gt;</a>
            @endif
        </div>
    </section>
</body>
@endsection