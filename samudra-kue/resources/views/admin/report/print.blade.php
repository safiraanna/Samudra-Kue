<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Bulanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Laporan Penjualan Bulanan</h1>
    <p class="text-center">Periode: {{ $startDate }} - {{ $endDate }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Total Terjual</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthlyDetails as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->product_name }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp {{ number_format($detail->price, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        <p>Total Penjualan: Rp {{ number_format($monthlyDetails->sum('price'), 2, '.', ',') }}</p>
    </div>
</body>
</html>
