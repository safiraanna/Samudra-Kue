@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div>
                <div>
                    <h3 class="mt-5">Daftar Produk</h3> 
                </div>

                <div class="m-auto pt-3 table-responsive">
                    <div>
                        <form action="{{ route('all.products') }}" method="GET">
                            <div class="form-group d-flex">
                                <input type="search" class="form-control form-control-lg mr-2" placeholder="Cari disini..." name="search" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID Product</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga Satuan</th>
                                <th scope="col">Harga Satuan dalam Dus</th>
                                <th scope="col">Satuan per Dus</th>
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
                                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn" type="submit"><span style="color: #D33F49; font-weight: bold">Hapus</span></button>
                                        </form>
                                        
                                        <form action="{{ route('products.edit', $product) }}" method="GET">
                                            <button class="btn" type="submit"><span style="color: #414288; font-weight: bold">Ubah</span></button>
                                        </form>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Paginasi Kustom -->
                    @include('layouts.pagination', ['paginator' => $products])
                </div>
            </div>
        </div>
    </section>
@endsection