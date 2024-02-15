@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div>
                <div class="col-md-6">
                    <h2 class="mt-5">Halaman Administrator</h2>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <h4 class="card-title">Total Pesanan</h4>
                                <h4 class="card-text">{{ $orders->count() }}</h4>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-4">
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <h4 class="card-title">Total Pendapatan</h4>
                                <h4 class="card-text">Rp {{ number_format($benefit, 2, '.', ',') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <h4 class="card-title">Pengguna Terdaftar</h4>
                                <h4 class="card-text">{{ $users->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <div>    
                <div class="mt-3">
                    <div>
                        <h3>Transaksi Terbaru</h3>
                    </div>

                    <div>
                        <div class="m-auto pt-3 table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Pelanggan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Total Harga</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($latestOrders as $index => $latestOrder)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $latestOrder->user ? $latestOrder->user->username : 'Tidak Ada User Terkait' }}</td>
                                            <td>{{ $latestOrder->created_at }}</td>
                                            <td>Rp {{ number_format($latestOrder->payment_total, 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="mt-3">
                    <div>
                        <h3>Produk yang Habis</h3>
                    </div>

                    <div>
                        <div class="m-auto pt-3 table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Produk</th>
                                        <th scope="col">Nama Produk</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($soldoutProducts as $soldout)
                                        <tr>
                                            <td>{{ $soldout->id }}</td>
                                            <td>{{ $soldout->product_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection