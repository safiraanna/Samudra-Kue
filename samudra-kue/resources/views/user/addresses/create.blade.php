@extends('layouts.main')

@section ('container')
    <section>
        <div class="container">
            <div class="col-md-6 m-auto">
                <div class="mt-3 mb-5">
                    <h3 class="mt-3 text-center">Alamat</h3>
                </div>

                <div class="card border-0 text-center">
                    <div class="card-body">
                        <form action="{{ route('addresses.store') }}" method="POST">
                            @csrf
                            @method('POST')
    
                            <div class="form-group mb-2">
                                <label for="province" class="m-2">Provinsi</label>
                                <input type="text" class="form-control rounded-top" name="province" id="province" placeholder="Provinsi" required>
                                {{-- <select class="form-select rounded-top" name="province" id="province">
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                </select> --}}
                            </div>
                            <div class="form-group mb-2">
                                <label for="city" class="m-2">Kabupaten/Kota</label>
                                <input type="text" class="form-control rounded-top" name="city" id="city" placeholder="Kota/Kabupaten" required>
                                {{-- <select class="form-select rounded-top" name="city" id="city">
                                    <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                                    <option value="Banjar">Banjar</option>
                                </select> --}}
                            </div>
                            <div class="form-group mb-2">
                                <label for="kecamatan" class="m-2">Kecamatan</label>
                                <input type="text" class="form-control rounded-top" name="kecamatan" id="kecamatan" placeholder="Kecamatan" required>
                                {{-- <select class="form-select rounded-top" name="kecamatan" id="kecamatan">
                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                    <option value="Banjar">Banjar</option>
                                    <option value="Purwaharja">Purwaharja</option>
                                    <option value="Pataruman">Pataruman</option>
                                    <option value="Langensari">Langensari</option>
                                </select> --}}
                            </div>
                            <div class="form-group mb-2">
                                <label for="kelurahan" class="m-2">Kelurahan</label>
                                <input type="text" class="form-control rounded-top" name="kelurahan" id="kelurahan" placeholder="Kelurahan" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="address" class="m-2">Alamat Detail </label>
                                <input type="text" class="form-control rounded-top" name="address" id="address" placeholder="Nama jalan, nomor rumah, etc..." required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="postal_code" class="m-2">Kode Pos</label>
                                <input type="text" class="form-control rounded-top" name="postal_code" id="postal_code" placeholder="Kode Pos" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn mt-3 text-white ml-auto" style="background-color: #7CA982">Simpan Alamat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection