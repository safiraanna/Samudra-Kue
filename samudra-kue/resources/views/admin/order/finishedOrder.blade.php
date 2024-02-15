@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mt-5">Pesanan Selesai</h3>
                </div>

                <div class="m-auto pt-3 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID Pesanan</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Tanggal Selesai</th>
                                <th scope="col">Status Pesanan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pesanan as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user ? $order->user->username : 'Tidak Ada User Terkait' }}</td>
                                    <td>{{ $order->payment_total }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td>{{ $order->order_status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pesanan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection