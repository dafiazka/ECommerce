
<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{url('assets/images/favicon.png')}}" type="">
      <title>Batik Keris @yield('title')</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{url('assets/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{url('assets/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{url('assets/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.html"><img width="250" src="{{url('assets/images/logo.png')}}" alt="#" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="@yield('class') || nav-item">
                            <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
                        </li>
                        @if (auth()->user()->role=='admin')
                        <li class="nav-item dropdown @yield('class2')">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <span class="nav-label">Products <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                               <li><a href="{{ url('/barang')}}">List</a></li>
                               <li><a href="{{ url('/barang/tambah')}}">Add</a></li>
                            </ul>
                         </li>
                         <li class="nav-item dropdown @yield('class3')">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <span class="nav-label">Pengirman <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                               <li><a href="{{ url('/kirim')}}">List</a></li>
                               <li><a href="{{ url('/kirim/tambah')}}">Add</a></li>
                            </ul>
                         </li>
                         <li class="nav-item dropdown @yield('class5')">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <span class="nav-label">Pembayaran <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                               <li><a href="{{ url('/metode')}}">List</a></li>
                               <li><a href="{{ url('/metode/tambah')}}">Add</a></li>
                            </ul>
                         </li>
                        @else
                        <li class="nav-item dropdown @yield('class2')">
                            <a class="nav-link" href="/barang">Products </a>
                        </li>
                        @endif
                        <li class="nav-item @yield('class4')">
                            <a class="nav-link" href="{{ url('/histori')}}">Histori</a>
                        </li>
                        <li class="nav-item @yield('class6')">
                            <?php
                            $keranjang_main = \App\Models\Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();
                            if (!empty($keranjang_main))
                            {
                                $notif = \App\Models\Pembayaran::where('id_keranjangs', $keranjang_main->id)->count();
                            }
                            ?>
                            <a class="nav-link" href="/keranjang">
                                <i class="fa fa-shopping-cart"></i>
                                @if (!empty($notif))
                                    <span class="badge bg-danger" style="color: white">{{ $notif }}</span>
                                @endif
                            </a>
                        </li>
                        <form >
                        </form>
                        <form class="form-inline" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                            <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            </button>
                        </form>
                        @endguest
                    </ul>
                </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->

    <section class="content">
        @yield('content')
    </section>

      <!-- jQery -->
      <script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{url('assets/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{url('assets/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{url('assets/js/custom.js')}}"></script>
   </body>
</html>
