<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
  <title> Veefin | {{ $title }}</title>
  <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet">
  @if(isset($css) && !empty($css))
  @foreach($css as $index => $cssList)
  <link href="{{url('assets/css/'.$cssList)}}" rel="stylesheet">
  @endforeach
  @endif
  <script src="{{url('assets/js/jquery-3.1.1.min.js')}}"></script>

  <style>
    .error {
      color: red;
      font-size: 14px;
      margin-top: -10px;
    }
  </style>
</head>

<body class="">
  <nav id="mdb-navbar" class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark shadow-1">
    <div class="container-fluid">
      <div class="collapse navbar-collapse d-flex justify-content-end">
       @if(Session::has('user')) <label class="text-white">Hello {{ session('user')->name }}</label>&nbsp;@endif
        <ul id="main-navbar" class="navbar-nav d-flex flex-row align-items-center flex-wrap ms-md-auto">
        <li id="gtmDC-login-button" class="nav-item">
            <a href="{{ url('product') }}" class="auth-modal-toggle btn btn-primary ripple-surface ms-2 me-1" data-auth-modal-tab="sign-in">Product</a>
          </li>&nbsp;
          @if (session('user'))
          @php
            $cartTotal = session('cart') ? array_sum(array_column($cart, 'quantity')) : 0;
          @endphp
          <li id="gtmDC-login-button" class="nav-item">
            <a href="{{ route('cart.view') }}" class="auth-modal-toggle btn btn-primary ripple-surface ms-2 me-1" data-auth-modal-tab="sign-in">Cart <span id="cart-count">{{ $cart ? $cartTotal : 0 }}</span></a>
          </li>&nbsp;
          <li id="gtmDC-login-button" class="nav-item">
            <a href="{{ url('logout') }} " class="auth-modal-toggle btn btn-primary ripple-surface ms-2 me-1" data-auth-modal-tab="sign-in">Logout</a>
          </li>
          @else{
          <li id="gtmDC-login-button" class="nav-item">
            <a href="{{ url('login') }}" class="auth-modal-toggle btn btn-primary ripple-surface ms-2 me-1" data-auth-modal-tab="sign-in">Login</a>
          </li>
          }
          @endif
        </ul>
      </div>
    </div>
  </nav>
  @yield('content')
</body>
<script src="{{url('assets/js/frm-submit.js?v=')}}{{rand()}}"></script>

</html>