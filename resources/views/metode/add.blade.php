@extends('layouts.main')

@section('title', '| Pembayaran - Add')

@section('class5', 'nav-item active')

@section('content')
<section class="product_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 col-lg-7">
                <div class="box">
                    <div class="detail-box justify-content-center">
                        <form method="POST" action="{{ url('/metode/tambah') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="text" id="nama" name="nama" required class="form-control">
                            </div>

                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Biaya &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="number" id="biaya" name="biaya" required min="0" required class="form-control">
                            </div>

                            <button type="submit" class="btn btn-success float-right mt-5" onclick="return confirm('Tambah Barang?')">
                                <i class="fa fa-save"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
