@extends('layouts.main')

<head>
    <style>
        /* Warna latar belakang dan warna ikon */
        .carousel-control-prev, .carousel-control-next {
            background-color: #f1f7ed;
            opacity: 20%;
        }
    
        /* Warna ikon */
        .carousel-control-prev-icon, .carousel-control-next-icon {
            color: #558564;
        }

        .carousel-item img {
        width: 100%;
        max-height: 360px; 
        object-fit: scale-down;
        }
        
        h2 {
            color: #ECA400;
        }
        
        #btnTemp {
            background-color: #558564;
            color: #FFFFFF;
            margin-top: 10pt;
        }
    </style>

    <script>
        @if(session('error'))
            alert("{{ session('error') }}");
        @endif
    </script>
</head>

@section('container')
    <section>
        <div>
            <div class="container mt-5"> 
                <div class="row">
                    <div class="col-md-6">
                        <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($product->images as $key => $image)
                                    <li data-target="#imageCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($product->images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/product_images/' . $image->picture_name) }}" class="d-block w-100" alt="{{ $product->product_name }}">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-text">{{ $product->product_name }}</h5>
                                <h2 class="card-text">Rp {{ number_format($product->price_unit, 2, '.', ',') }}</h2>
                                <h6 class="card-text mt-3 mb-5">Tersedia {{ $product->stocks }} buah</h6>
                                <p>Pembelian diatas {{$product->unit_per_box}} buah, harga satuan menjadi Rp {{ number_format($product->price_box_unit, 2, '.', ',')}}</p>

                                <form action="{{ route('add_to_cart', ['id' => $product->id]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="quantity">Jumlah:</label>
                                        <input type="number" class="form-control mt-3" name="quantity" id="quantity" value="1">
                                    </div>
                                    <button type="submit" class="btn" id="btnTemp">+ Tambah ke Keranjang</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
                
                <div class="col-md-12 mt-3">
                    <div class="card" >
                        <div class="card-body">
                            <h6 class="card-text m-2 mb-3" style="text">Tentang produk</h6>
                            <p class="card-text m-2">{!! nl2br(e($product->description)) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection