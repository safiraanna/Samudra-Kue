@extends('layouts.main')

@section('container')
    <section>
        <div class="container">
            <div class="row">
                <div class="mt-3">
                    <h3 class="mt-3 text-center">Pesanan Saya</h3>
                </div>

                <div class="col-md-d p-5" >
                    @if ($orders->isEmpty())
                        <p>Anda belum membuat pesanan apapun</p>
                    @else
                        @foreach ($orders as $index => $order)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <div class="">
                                                <h5 class="d-inline">Pesanan {{ $index + 1}} : </h5>

                                                <div class="d-inline text-right">
                                                    <button class="btn text-dark" style="background-color: #fafafa">
                                                            <p>{{$order->order_status}}</p>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="text-right">
                                                <a href="{{ route('orders.details', ['orderID' => $order->id]) }}"><button class="btn text-white" style="background-color: #7CA982">Lihat Detail</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection