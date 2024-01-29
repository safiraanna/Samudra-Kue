@extends('layouts.admin')

@section('content')
    <section>
        <div class="container">
            <div>
                <div>
                    <h3>Sales Report</h3>
                </div>

                <div>
                    <h5>Total Penjualan per Minggu</h5>

                    <div class="m-auto pt-3 table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Minggu</th>
                                    <th scope="col">Total Penjualan</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @foreach ($weeklySales as $sales)
                                    <tr>
                                        <td>{{ $sales->year }}</td>
                                        <td>{{ $sales->month }}</td>
                                        <td>{{ $sales->week }}</td>
                                        <td>Rp {{ number_format($sales->total_sales, 2, '.', ',') }}</td>
                                        <td><a href="{{ route('weekly.sales.details', ['year' => $sales->year, 'month' => $sales->month, 'week' => $sales->week]) }}">details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br><br>
    
                        <h5>Top 10 Produk Terlaris Minggu Ini</h5>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Total Terjual</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($bestProducts as $product)
                                    <tr>
                                        <td>{{ $product->product->product_name }}</td>
                                        <td>{{ $product->total_sold }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection