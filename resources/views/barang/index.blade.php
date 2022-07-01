@extends('layouts.main')

@section('title', '| Product')

@section('class2', 'nav-item active')

@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
       <div class="row">
          <div class="col-md-12">
             <div class="full">
                <h3>Product</h3>
             </div>
          </div>
       </div>
    </div>
</section>

<!-- product section -->
<section class="product_section layout_padding">
    <div class="container">
        <div class="row">
            @foreach ($barangs as $barang)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    @if (auth()->user()->role=='admin')
                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('/detail', $barang->id ) }}" class="option1">
                                View
                            </a>
                            <a href="{{ url('barang/edit', $barang->id) }}" class="option3">
                                Edit
                            </a>
                            <form action="{{ url('barang/hapus', $barang->id) }}" method="POST" onsubmit="return confirm('Hapus Barang?')">
                                @method('delete')
                                @csrf
                                <button type="submit" class="option2">Delete</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('/detail', $barang->id ) }}" class="option1">
                                Buy Now
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="img-box">
                        <img src="{{ asset('images/post/'.$barang->gambar) }}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{ $barang->nama_barang }}
                        </h5>
                        <h6>
                            Rp. {{ number_format($barang->harga) }}
                        </h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- end product section -->

 {{-- <div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div> --}}
@endsection
