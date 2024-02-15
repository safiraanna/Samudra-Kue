@extends('layouts.main')

@section ('container')
    <section>
        <div class="container">
            <div class="row">
                <div class="mt-3 mb-5">
                    <h3 class="mt-3 text-center">Edit Alamat</h3>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('addresses.update', ['id' => $address->id]) }}" method="POST">
                            @csrf
    
                            <div class="form-group mb-2">
                                <label for="province" class="m-2">Provinsi</label>
                                <input type="text" class="form-control rounded-top" name="province" id="province" value="{{ $address->province }}">
                                {{-- <select class="form-select rounded-top" name="province" id="province">
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                </select> --}}
                            </div>
                            <div class="form-group mb-2">
                                <label for="city" class="m-2">Kabupaten/Kota</label>
                                <input type="text" class="form-control rounded-top" name="city" id="city" value="{{ $address->city }}">
                                {{-- <select class="form-select rounded-top" name="city" id="city">
                                    <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                                    <option value="Banjar">Banjar</option>
                                </select> --}}
                            </div>
                            <div class="form-group mb-2">
                                <label for="kecamatan" class="m-2">Kecamatan</label>
                                <input type="text" class="form-control rounded-top" name="kecamatan" id="kecamatan" value="{{ $address->kecamatan }}">
                                {{-- <select class="form-select rounded-top" name="kecamatan" id="kecamatan">
                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                    <option value="Banjar">Banjar</option>
                                    <option value="Purwaharja">Purwaharja</option>
                                    <option value="Pataruman">Pataruman</option>
                                    <option value="Langensari">Langensari</option>
                                </select> --}}
                            </div>
                            <div class="form-group mb-2">
                                <label for="kelurahan" class="m-2">Kelurahan : </label>
                                <input type="text" class="form-control rounded-top" name="kelurahan" id="kelurahan" value="{{ $address->kelurahan }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="address" class="m-2">Detail Alamat : </label>
                                <input type="text" class="form-control rounded-top" name="address" id="address" value="{{ $address->address }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="postal_code" class="m-2">Postal Code : </label>
                                <input type="text" class="form-control rounded-top" name="postal_code" id="postal_code" value="{{ $address->postal_code }}">
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn mt-3 text-white ml-auto" style="background-color: #558564">Simpan Alamat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection