@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mt-5">Daftar Produk</h3> 
                </div>

                {{-- <div>
                    <p>Cari</p>
                    <form>
                        <div>
                            <input type="search" placeholder="cari produk..." name="search" value="{{ $request('search') }}" aria-label="Search">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div> --}}

                <div class="m-auto pt-3 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID Product</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Harga Satuan dalam Dus</th>
                                <th scope="col">Satuan per Dus</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->stocks }}</td>
                                    <td>{{ $product->price_unit }}</td>
                                    <td>{{ $product->price_box_unit }}</td>
                                    <td>{{ $product->unit_per_box }}</td>
                                    <td>
                                        <form action="{{ route('products.destroy', $product) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>

                                        <br>
                                        
                                        <form action="{{ route('products.edit', $product) }}" method="GET">
                                            <button class="btn btn-primary" type="submit">Edit</button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-4">
                        @if ($products->previousPageUrl())
                            <a href="{{ $products->previousPageUrl() }}" class="btn btn-primary" rel="prev">&lt;</a>
                        @endif
                        
                        @if ($products->nextPageUrl())
                            <a href="{{ $products->nextPageUrl() }}" class="btn btn-primary ml-3" rel="next">&gt;</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection