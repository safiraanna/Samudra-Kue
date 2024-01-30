@extends('layouts.main')

@section('container')
    <section>
        <div class="container">
            <div class="row">
                <div class="">
                    <h3 class="mt-3 text-center mb-5">Checkout</h3> 
                </div>

                <div class="col-md-d">
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <div>
                                <label for="address">Alamat Pengiriman :</label>
                                @if ($shippingAddress)
                                    <input type="hidden" name="address" id="address" class="form-control mt-1 mb-2" value="{{ $shippingAddress->id }}">
                                    <p>{{ $shippingAddress->province }}, {{ $shippingAddress->city }}, {{ $shippingAddress->kecamatan }}, {{ $shippingAddress->kelurahan }}, {{ $shippingAddress->address }}, {{ $shippingAddress->postal_code }}</p>
                                @else
                                    <p>Tidak ada alamat yang tersedia</p>
                                @endif
                            </div>
                            
                            <div class="mt-3">
                                <div>
                                    @foreach ($cartItems as $cartItem)
                                        @if ($cartItem->chosen == 1)
                                            <input type="hidden" name="chosenProducts[]" value="{{ $cartItem->product->id }}">
                                            <p>{{ $cartItem->product->product_name }} X {{ $cartItem->qty }}</p> 
                                            <p class="text-right">Subtotal : {{ number_format($cartItem->price_subtotal, 2, '.', ',') }}</p>
                                        @endif
                                    @endforeach
                                </div>

                                <div>
                                    <label for="payment_method" style="display: inline">Metode Pembayaran</label>
                                    <select name="payment_method" id="payment_method" class="form-control mt-1" style="display: inline">
                                        <option value="online_payment">Pembayaran Online</option>
                                        <option value="cash_on_delivery">Bayar Tunai Saat Pengiriman</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-2 text-right">
                                <div>
                                    <label for="payment_total">Total Pesanan: Rp {{ number_format($total, 2, '.', ',') }}</label>
                                    <input type="hidden" name="payment_total" value="{{ $total }}">
                                </div>

                                <div>
                                    <label for="shipping_cost">Biaya Pengiriman: Rp {{ number_format($shippingCost, 2, '.', ',') }}</label>
                                    <input type="hidden" name="shipping_cost" value="{{ $shippingCost }}">
                                </div>
                            </div>

                            <div>
                                <label for="add_notes" class="mt-3">Catatan Tambahan </label>
                                <input type="text" id="add_notes" name="add_notes" class="form-control mt-1" placeholder="Tulis catatanmu disini...">
                            </div>
                        </div>                    
                    
                        <!-- Tombol Submit -->
                        <button type="submit" class="btn mt-3 text-white" id="checkout-button" style="background-color: #7CA982">+ Buat Pesanan</button>
                    </form> 
                </div>
            </div>
        </div>
    </section>
@endsection