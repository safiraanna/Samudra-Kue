<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-udu3XJC0BvEB7YA3"></script>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

  <title>Document</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div container d-flex justify-content-center>
    <div class="card">
      <div>
        <div>

        </div>

        <div class="py-2 px-3">
          <div class="second pl-2 d-flex py-2">
            <div class="form-check"></div>

            <div><span class="head">Name</span>
              <div><span class="dollar"></span>{{ $name }}</div>
            </div>
          </div>
        </div>

        <div class="py-2 px-3">
          <div class="second pl-2 d-flex py-2">
            <div class="form-check"></div>

            <div><span class="head">Nomor Telepon</span>
              <div><span class="amount">{{ $phone_number }}</span></div>
            </div>
          </div>
        </div>

        <div class="py-2 px-3">
          <div class="second pl-2 d-flex py-2">
            <div class="form-check"></div>

            <div><span class="head">Alamat</span>
              <div><span class="dollar"></span>{{ $address }}</div>
            </div>
          </div>
        </div>

        <div class="py-2 px-3">
          <div class="second pl-2 d-flex py-2">
            <div class="form-check"></div>

            <div><span class="head">Total Amount Due</span>
              <div><span class="dollar">Rp.</span><span>{{ $address }}</span></div>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-between px-3 pt-4 pb-3">
          {{-- <a href="{{ route('menu.cart') }}"><div><span class="back">Go Back</span></div></a> --}}
          <button type="button" id="pay-button" class="btn btn-warning button">Pay amount</button>
        </div>
      </div>
    </div>
  </div>

  <form action="/checkout" id="submit_form" method="POST">
    @csrf
    {{-- ini biar data payment bisa masuk ke database, jadi kita akalin pake id "json_callback" yang di olah pake kodingan func
     send_response_to_form(result) --}}
    <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="address" value="{{ $address }}">
    <input type="hidden" name="cart" value="{{ $cart }}">
    <input type="hidden" name="phonenumber" value="{{ $phonenumber }}">
    <input type="hidden" name="json" id="json_callback">
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {

    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{$snapToken}}', {
      onSuccess: function(result){
        /* You may add your own implementation here */
        console.log(result);
        send_response_to_form(result);
      },
      onPending: function(result){
        /* You may add your own implementation here */
        console.log(result);
        send_response_to_form(result);
      },
      onError: function(result){
        /* You may add your own implementation here */
        console.log(result);
        send_response_to_form(result);
      },
      onClose: function(){
        /* You may add your own implementation here */
        alert('you closed the popup without finishing the payment');
      }
    })
  });

  function send_response_to_form(result){
    //jadi masukan hasil result berbentuk JSON yang telah di ubah ke bentuk string oleh JSON.stringify, ke dalam value json_callback
    document.getElementById('json_callback').value = JSON.stringify(result);

    // //buat coba-coba
    // alert(document.getElementById('json_callback').value);

    //submit hasil nya ke hidden form melalui id "submit_form"
    $('#submit_form').submit();
  }
  </script>
</body>
</html>