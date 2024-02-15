@extends('layouts.main')

@section('container')
    <section>
        <div class="container">
            <div>
                <div>
                    <h3 class="pt-5 pb-5">Detail Pesanan</h3>
                </div>

                <div>
                    <form action="{{route('payment.process', ['orderID' => $order->id])}}" method="POST" id="payment-process">
                        @csrf
                        @method('POST')

                        <div>
                            <h6 class="d-inline">Status Pesanan : </h6>
                            <span>{{ $order->order_status }}</span>
                        </div>  

                        <div class="text-right mb-1">
                            <a style="text-decoration: none" href="{{ url('/generate-invoice/' . $order->id) }}" target="_blank">Lihat Invoice</a>
                        </div>
        
                        <div class="card">
                            <div class="card-body">
                                @foreach ($order->orderItems as $orderItem)
                                    <p style="font-weight: 500">{{ $orderItem->product->product_name }} X {{ $orderItem->qty }}</p>
                                    <p class="text-right">Rp{{ number_format($orderItem->price, 2, '.', ',') }}</p>
                                @endforeach
                            </div>
        
                            <div class="card-body text-right">
                                <p>Biaya Pengiriman : Rp{{ number_format($order->shipping_cost, 2, '.', ',') }}</p>
                                <p>Total Pembayaran : Rp{{ number_format($order->payment_total + $order->shipping_cost, 2, '.', ',') }} </p>
                            </div>
                        </div>
        
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="card-text">
                                    <h6 class="d-inline">Catatan Tambahan:</h6>
                                    <p class="d-inline">{{ $order->add_notes }}</p>
                                </div>
                            </div>
                        </div>
                        
                        @if($order->payment_method !== 'cash_on_delivery')
                            <button type="submit" class="btn mt-3 text-white" id="checkout-button" style="background-color: #7CA982">Bayar Sekarang</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection