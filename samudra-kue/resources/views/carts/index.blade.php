@extends('layouts.main')

@section('container')
    <section>
        <div class="container">
            <div class="row">
                <div class="mt-3">
                    <h3 class="mt-3 text-center">Keranjang Saya</h3>
                </div>

                <div class="col-md-d p-5">
                    <form action="{{ route('checkout.process') }}" method="POST" id="cart-form">
                        @csrf
                        @method ('POST')
                    
                        @if ($cartItems->isEmpty())
                            <p>Keranjang anda kosong! Ayo isi dulu</p>
                        @else
                            @foreach ($cartItems as $cartItem)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-1 mb-2">
                                                <input type="checkbox" class="form-check-input checkbox-chosen" data-product-id="{{ $cartItem->product->id }}" name="chosen[]" value="{{ $cartItem->product->id }}" />
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <h5 class="card-title">{{ $cartItem->product->product_name }}</h5>
                                        </div>
                                        <div class="col-1">
                                            <p class="card-text">x {{ $cartItem->qty }}</p>
                                        </div>
                                    </div>

                                    <div class="col-11 ml-5 text-right">
                                        <p class="card-text">Harga : {{ number_format($cartItem->product->price_unit, 2, '.', ',') }}</p>
                                        <p class="card-text">Subtotal : {{ number_format($cartItem->price_subtotal, 2, '.', ',') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="mt-3 text-right">
                            <button type="submit" class="btn text-white" style="background-color: #7CA982" id="checkout-button">Checkout Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection