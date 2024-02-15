<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->id }}</title>

    <style>
        .w-full {
            width: 100%;
        }
        .w-half {
            width: 50%;
        }
        .footer {
            font-size: 0.875rem;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <h1>Invoice #{{ $order->id }}</h1>
    <p>Tanggal: {{ $order->created_at }}</p>
    <br>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div><h4>Untuk:</h4></div>
                    <p style="font-weight: bold">{{ $order->user->full_name }}</p>
                    <p>(+62){{ $order->user->phone_number }}</p>
                </td>
                <td class="w-half">
                    <div><h4>Dari:</h4></div>
                    <p style="font-weight: bold">Toko Samudra Kue</p>
                    <p>Jl. Hamara Efendi No.262, Banjar, Jawa Barat 46322</p>
                    <p>760-355-3930</p>
                </td>
            </tr>
        </table>
    </div>

    <table border="none" width="100%">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $item)
                <tr>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->product->price_unit, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th>Rp {{number_format($order->payment_total, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <br><br><br>

    <div class="footer margin-top">
        <div>Terima Kasih</div>
        <div>&copy; Samudra Kue</div>
    </div>
</body>
</html>
