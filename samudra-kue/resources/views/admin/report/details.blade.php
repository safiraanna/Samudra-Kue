@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div>
                <h5 class="mb-3">Weekly Sales Report</h5>
                
                <p>Periode: {{ $startDate->toDateString() }} - {{ $endDate->toDateString() }}</p>
                <p>Total Pemasukkan: Rp {{ number_format($totalRevenue, 2, '.', ',') }}</p>
            </div>

            <div class="m-auto pt-3 table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">OrderID</th>
                            <th scope="col">UserID</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Total Terjual</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($weeklyDetails as $detail)
                            <tr>
                                <td>{{ $detail->orderID }}</td>
                                <td>{{ $detail->userID }}</td>
                                <td>{{ $detail->product_name }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>Rp {{ number_format($detail->price, 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection