@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div class="">
                <div class="col-md-6">
                    <h3 class="mt-5">Halaman Administrator</h3>
                </div>

                <div class="row mt-4">
                    <div class="col-4">
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <p class="card-title">Pesanan Bulan Ini</p>
                                <p class="card-text">{{ $orders->count() }}</p>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-4">
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <p class="card-title">Jumlah Pemasukan Bulan ini</p>
                                <p class="card-text">Rp {{ number_format($benefit, 2, '.', ',') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card border-dark">
                            <div class="card-body text-center">
                                <p class="card-title">Pengguna Aktif</p>
                                <p class="card-text">{{ $users->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-lg-5">
                    <div class="col-md-12">
                        <h3>Riwayat Transaksi</h3>
                    </div>

                    <div class="col-md-12 ">
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
                                    @foreach ($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->user ? $order->user->username : 'Tidak Ada User Terkait' }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>Rp {{ number_format($order->payment_total, 2, '.', ',') }}</td>
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