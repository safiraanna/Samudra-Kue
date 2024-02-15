@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div>
                <div>
                    <h3 class="mt-5">Daftar Pengguna</h3>
                </div>

                <div class="m-auto pt-3 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID Pengguna</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nomor Telepon</th>
                                <th scope="col">Jumlah Pesanan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pengguna as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->orders->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pengguna->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection