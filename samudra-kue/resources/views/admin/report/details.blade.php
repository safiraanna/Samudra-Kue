@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div>
                <h5 class="mb-3">Monthly Sales Report</h5>
                
                <p>Periode: {{ $startDate->toDateString() }} - {{ $endDate->toDateString() }}</p>
                <!--<p>Total Pemasukkan: Rp {{ number_format($totalSales, 2, '.', ',') }}</p>-->
            </div>

            <div class="m-auto pt-3 table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Total Terjual</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($monthlyDetails as $detail)
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