@extends('layouts.main')

@section('container')
    <section>
        <div class="container">
            <div class="row">
                <div>
                    <h3 class="mt-3 text-center mb-5">Checkout</h3> 
                </div>

                <div class="col-md-d">
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <div class="card">
                                <div class="card-body">
                                    <label for="address">Alamat Pengiriman :</label>
                                    @if ($shippingAddress)
                                        <input type="hidden" name="address" id="address" class="form-control" value="{{ $shippingAddress->id }}">
                                        <p>{{ $shippingAddress->province }}, {{ $shippingAddress->city }}, {{ $shippingAddress->kecamatan }}, {{ $shippingAddress->kelurahan }}, {{ $shippingAddress->address }}, {{ $shippingAddress->postal_code }}</p>
                                    @else
                                        <p>Tidak ada alamat yang tersedia</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="mt-3">
                                        <div>
                                            @foreach ($cartItems as $cartItem)
                                                @if ($cartItem->chosen == 1)
                                                    <input type="hidden" name="chosenProducts[]" value="{{ $cartItem->product->id }}">
                                                    <p>{{ $cartItem->product->product_name }} X {{ $cartItem->qty }}</p> 
                                                    <p class="text-right">Subtotal : Rp {{ number_format($cartItem->price_subtotal, 2, ',', '.') }}</p>
                                                @endif
                                            @endforeach
                                        </div>
        
                                        <div>
                                            <label for="payment_method" style="display: inline">Metode Pembayaran</label>
                                            <select name="payment_method" id="payment_method" class="form-control mt-1" style="display: inline">
                                                <option value="" disabled selected>Pilih metode pembayaran</option>
                                                <option value="online_payment">Pembayaran Online</option>
                                                <option value="cash_on_delivery">Bayar Tunai Saat Pengiriman</option>
                                            </select required>
                                        </div>
                                    </div>
        
                                    <div class="mt-2 text-right">
                                        <div>
                                            <label for="shipping_cost">Biaya Pengiriman: Rp {{ number_format($shippingCost, 2, ',', '.') }}</label>
                                            <input type="hidden" name="shipping_cost" value="{{ $shippingCost }}">
                                        </div>
                                        
                                        <div class="mt-3">
                                            <label for="payment_total">Total Pesanan: <span style="color: #ECA400; font-weight: bold">Rp {{ number_format($total, 2, ',', '.') }}</span></label>
                                            <input type="hidden" name="payment_total" value="{{ $total }}">
                                        </div>
                                    </div>
        
                                    <div>
                                        <label for="add_notes" class="mt-3">Catatan Tambahan </label>
                                        <input type="text" id="add_notes" name="add_notes" class="form-control mt-1" placeholder="Tulis catatanmu disini...">
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    
                        <!-- Tombol Submit -->
                        <button type="submit" class="btn mt-3 text-white" id="checkout-button" style="background-color: #558564">+ Buat Pesanan</button>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form> 
                </div>
            </div>
        </div>
    </section>
@endsection