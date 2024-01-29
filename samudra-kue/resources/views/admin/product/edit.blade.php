@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div class="">
                <div class="">
                    <h3 class="mt-5 mb-3">Ubah Spesifikasi Produk</h3>
                </div>

                <div class="row">
                    <div class="card col-md-8 border-0">
                        <div class="card-body">
                            <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
    
                                <div class="form-group mb-2">
                                    <label for="product_name">Nama Product</label>
                                    @error('product_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                    @enderror
                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" id="product_name" value="{{ $product->product_name }}">
                                </div>
    
                                <div class="form-group mb-2">
                                    <label for="price_unit">Harga Satuan Kotak/Renceng</label>
                                    <input type="text" class="form-control" name="price_unit" id="price_unit" value="{{ $product->price_unit }}">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="price_box_unit">Harga Satuan Dus</label>
                                    <input type="text" class="form-control" name="price_box_unit" id="price_box_unit" value="{{ $product->price_box_unit }}">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="unit_per_box">Jumlah Satuan Kotak/Renceng Per Dus</label>
                                    <input type="text" class="form-control" name="unit_per_box" id="unit_per_box" value="{{ $product->unit_per_box }}">
                                </div>
    
                                <div class="form-group mb-2">
                                    <label for="stocks">Jumlah Ketersediaan Produk</label>
                                    <input type="text" class="form-control" name="stocks" id="stocks" value="{{ $product->stocks }}">
                                </div>
    
                                <div class="form-group mb-2">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" cols="10" rows="5" class="form-control"> {{ $product->description }} </textarea>
                                </div>
    
                                <div class="form-group mb-2">
                                    <label for="images">Masukkan Gambar</label>
                                    <input type="file" class="form-control" name="images" id="images">
                                </div>
    
                                <button class="btn btn-block form-control mt-3 text-white" style="background-color: #30343f">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection