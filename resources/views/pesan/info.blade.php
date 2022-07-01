@extends('layouts.main')

@section('title', '| Product')

@section('class2', 'nav-item active')

@section('content')
<section class="product_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-6">
                <div class="box">
                    <center>
                        <img src="{{ asset('images/post/'.$barang->gambar) }}" style="max-width: 100%; max-height: 408px;">
                    </center>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-6">
                <div class="box">
                    <div class="detail-box">
                        <h1>
                            {{ $barang->nama_barang }}
                        </h1>
                    </div>
                    <hr>
                    <div class="detail-box">
                        <h6 style="color: #f5a280">
                            Deskripsi &nbsp;:
                        </h6>
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{ $barang->deskripsi }}
                        </h5>
                    </div>
                    <div class="detail-box">
                        <h6 style="color: #f5a280">
                            Stok&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                        </h6>
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{ $barang->stok }}
                        </h5>
                    </div>
                    <div class="detail-box">
                        <h6 style="color: #f5a280">
                            Harga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                        </h6>
                    </div>
                    <div class="detail-box">
                        <h5>
                            Rp. {{ number_format($barang->harga) }}
                        </h5>
                    </div>
                    <hr>
                    <br>
                    <div class="detail-box">
                        <h5 style="color: #f5a280">
                            Pesan :
                        </h5>
                        <form action="{{ url('/order', $barang->id) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="number" id="jumlah_barang" name="jumlah_barang" required min="1" class="form-control">&nbsp;
                                <button type="submit" class="btn btn-warning" onclick="return confirm('Pesan?')">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
