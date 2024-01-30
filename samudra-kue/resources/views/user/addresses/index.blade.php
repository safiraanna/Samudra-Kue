@extends('layouts.main')

@section('container')
    <section>
        <div class="container">
            <div class="row">
                <div class="mt-3">
                    <h3 class="mt-3 text-center">Alamat Saya</h3>
                </div>

                <div class="col-md-d p-5">
                    @if ($shippingAddress)
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <h5 class="card-title">Alamat : </h5>
                                    </div>
                                    <div class="col-8">
                                        <p class="card-text">
                                            {{ $shippingAddress->address }}, {{ $shippingAddress->kelurahan }}, {{ $shippingAddress->kecamatan }}, {{ $shippingAddress->city }}, {{ $shippingAddress->province }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3 text-center">
                            <a href="{{ route('addresses.edit', $shippingAddress) }}">
                                <button type="submit" class="btn text-white" style="background-color: #558564">+Edit Alamat</button>
                            </a>
                        </div>
                    @else
                        <p>Anda belum menyimpan alamat</p>
                        <div class="mt-3 text-center">
                            <a href="{{ route('addresses.create') }}">
                                <button type="submit" class="btn text-white" style="background-color: #558564">+Tambah Alamat</button>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
