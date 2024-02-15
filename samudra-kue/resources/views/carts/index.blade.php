@extends('layouts.main')

<head>
    <style>
        input[type="checkbox"]:checked {
            background-color: ECA400;
        }
        
        #clear-cart-button {
            color: #D33F49;
        }
    </style>
</head>

@section('container')
    <section>
        <div class="container">
            <div class="row">
                <div class="mt-3">
                    <h3 class="mt-3 text-center">Keranjang Saya</h3>
                </div>
                
                <div class="mt-3 text-right">
                    <form action="{{ route('cart.clear') }}" method="POST" id="clear-cart-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" id="clear-cart-button">Hapus Seluruh Isi Keranjang</button>
                    </form>
                </div>

                <div class="col-md-d p-3 pt-0">
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
                                            <div class="col-lg-1 col-md-1 mb-2">
                                                <input type="checkbox" class="form-check-input checkbox-chosen" data-product-id="{{ $cartItem->product->id }}" name="chosen[]" value="{{ $cartItem->product->id }}" />
                                            </div>
                                            
                                            <div class="col-lg-10 col-md-4 ml-auto">
                                                <h5 class="card-title">{{ $cartItem->product->product_name }}</h5>
                                            </div>
                                            
                                            <div class="col-lg-1 col-md-1 text-right">
                                                <p class="card-title">x {{ $cartItem->qty }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="ml-5 text-right">
                                            <p class="card-text">Subtotal : <span style="color: #ECA400; font-weight: bold">{{ number_format($cartItem->price_subtotal, 2, '.', ',') }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="mt-3 text-right">
                            <button type="submit" class="btn text-white" style="background-color: #558564" id="checkout-button">Checkout Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection