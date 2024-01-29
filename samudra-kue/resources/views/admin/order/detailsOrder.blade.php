@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div>
                <div>
                    <h3 class="pt-5 pb-5">Detail Pesanan</h3>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-text mb-2">
                            <h6 class="d-inline">Nama Pelanggan : </h6>
                            <p class="d-inline">{{ $order->user->username }}</p>
                        </div>

                        <div class="card-text mb-2">
                            <h6 class="d-inline">Tanggal Pemesanan : </h6>
                            <p class="d-inline">{{ $order->created_at }}</p>
                        </div>

                        <div class="card-text mb-2">
                            <h6 class="d-inline">Alaman Pengantaran : </h6>
                            <p class="d-inline">{{ $order->address->address }}, {{ $order->address->postal_code }}, {{ $order->address->kelurahan }}, {{ $order->address->kecamatan }}, {{ $order->address->city }}, {{ $order->address->province }}</p>
                        </div>
                    </div>
                </div>

                <div class="m-auto pt-3 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Kuantitas</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orderItems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->product->product_name }}</td>
                                    <td>{{ $orderItem->qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="card-text">
                            <h6 class="d-inline">Catatan Tambahan:</h6>
                            <p class="d-inline">{{ $order->add_notes }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection