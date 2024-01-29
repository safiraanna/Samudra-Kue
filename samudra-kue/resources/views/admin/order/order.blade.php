@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mt-5">Pesanan</h3>
                </div>

                <div class="m-auto pt-3 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID Pesanan</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col">Status Pesanan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pesanan as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user ? $order->user->username : 'Tidak Ada User Terkait' }}</td>
                                    <td>{{ $order->payment_total }}</td>
                                    <td>
                                        {{ $order->payment_status }}
                                        {{-- @if ($order->payment_status == 0)
                                            Belum Bayar
                                        @elseif ($order->payment_status == 1)
                                            Sudah Bayar
                                        @else
                                            Status tidak diketahui
                                        @endif --}}
                                    </td>
                                    <td>
                                        {{ $order->order_status }}
                                        {{-- @if ($order->order_status == 0)
                                            Belum Diproses
                                        @elseif ($order->order_status == 1)
                                            Sedang Diproses
                                        @else
                                            Status tidak diketahui
                                        @endif --}}
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateStatusModal{{ $order->id }}">
                                                Ubah Status
                                            </button>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('details.orders', ['order' => $order->id]) }}"><button type="button" class="btn btn-primary">Lihat Pesanan</button></a>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="updateStatusModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('updateOrderStatus', $order->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateStatusModalLabel">Ubah Status Pesanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="order_status">Status Pesanan</label>
                                                        <select name="order_status" id="order_status" class="form-control">
                                                            {{-- <option value="Pesanan diterima oleh toko" @if ($order->order_status == 'Pesanan diterima oleh toko') selected @endif>Belum Diproses</option> --}}
                                                            <option value="Pesanan sedang dikemas" @if ($order->order_status == 'Pesanan sedang dikemas') selected @endif>Sedang Diproses</option>
                                                            <option value="Pesanan dalam pengantaran ke tujuan" @if ($order->order_status == 'Pesanan sedang dikemas') selected @endif>Sedang Diantar</option>
                                                            <option value="Pesanan selesai" @if ($order->order_status == 'Pesanan selesai') selected @endif>Pesanan Selesai</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>    
@endsection