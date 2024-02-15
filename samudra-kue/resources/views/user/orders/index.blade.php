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
                                            <div class="row">
                                                <h5 class="col-lg-2">Pesanan {{ $index + 1}} : </h5>
                                                <p class="col-lg-10 text-right" style="color: #ECA400; font-weight: bold">{{$order->order_status}}</p>
                                            </div>
                                            
                                            <div class="text-right">
                                                <a href="{{ route('orders.details', ['orderID' => $order->id]) }}"><button class="btn text-white" style="background-color: #558564">Lihat Detail</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- @endif --}}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection