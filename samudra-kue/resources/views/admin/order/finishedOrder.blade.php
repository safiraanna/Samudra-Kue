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
                                <th scope="col">Status Pesanan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pesanan as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user ? $order->user->username : 'Tidak Ada User Terkait' }}</td>
                                    <td>{{ $order->payment_total }}</td>
                                    <td>
                                        @if ($order->order_status == 'Pesanan Selesai')
                                            Pesanan Selesai
                                        @else
                                            Status tidak diketahui
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection