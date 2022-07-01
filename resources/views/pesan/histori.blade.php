@extends('layouts.main')

@section('title', '| Histori')

@section('class4', 'nav-item active')

@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
       <div class="row">
          <div class="col-md-12">
             <div class="full">
                <h3>Histori</h3>
             </div>
          </div>
       </div>
    </div>
</section>

<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="row">
            @foreach ($historis as $histori)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('/histori/nota/'. $histori->id ) }}" class="option1">
                                View
                            </a>
                        </div>
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{ $histori->kode }}
                        </h5>
                    </div>
                    <div class="detail-box mt-5">
                        <h6> Total </h6>
                    </div>
                    <div class="detail-box">
                        <h6>
                            {{ $histori->jumlah_barang }} Barang
                        </h6>
                        <h5>
                            Rp. {{ number_format($histori->harga_total) }}
                        </h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- end product section -->
@endsection
