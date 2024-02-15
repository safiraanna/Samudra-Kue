@extends('layouts.main')

@section('container')
    <section>
        <div class="container">
            <div>
                <div>
                    <h3 class="pt-5 pb-5">Pembayaran</h3>
                </div>

                <div class="py-2 px-3">
                    <div class="second pl-2 d-flex py-2">
                      <div class="form-check"></div>
          
                      <div class="border-left pl-2">
                        <span class="head">Total pembayaran</span>
                        <div>
                          <span class="dollar">Rp.</span>
                          <span class="amount">{{$order->payment_total}}</span>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="text-right">
                    <button type="button" class="btn mt-3 text-white" id="pay-button" style="background-color: #558564">Bayar</button>
                </div>
            </div>
        </div>

        <form action="{{ route('update.checkout') }}" id="submit_form" method="POST">
            @csrf
            {{-- ini biar data payment bisa masuk ke database, pake id "json_callback" yang di olah pake kodingan func
             send_response_to_form(result) --}}
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="json" id="json_callback">
          </form>

        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-udu3XJC0BvEB7YA3"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        
        <script type="text/javascript">
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
                window.snap.pay('{{$snapToken}}' , {
                    onSuccess: function (result) {
                        /* Implementasi ketika pembayaran berhasil */
                        // alert("Pembayaran berhasil!");
                        console.log(result);
                        send_response_to_form(result);
                    },
                    onPending: function (result) {
                        /* Implementasi ketika pembayaran masih tertunda */
                        // alert("Pembayaran masih tertunda");
                        console.log(result);
                        send_response_to_form(result);
                    },
                    onError: function (result) {
                        /* Implementasi ketika pembayaran gagal */
                        // alert("Pembayaran gagal!");
                        console.log(result);
                        send_response_to_form(result);
                    },
                    onClose: function () {
                        /* Implementasi ketika popup ditutup tanpa menyelesaikan pembayaran */
                        alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                    }
                })
            });

            function send_response_to_form(result) {
                document.getElementById('json_callback').value = JSON.stringify(result);

                // alert(document.getElementById('json_callback').value);
                $('#submit_form').submit();;
            }
        </script>
    </section>
@endsection