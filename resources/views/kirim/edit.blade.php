@extends('layouts.main')

@section('title', '| Pengiriman - Edit')

@section('class3', 'nav-item active')

@section('content')
<section class="product_section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 col-lg-7">
                <div class="box">
                    <div class="detail-box justify-content-center">
                        <form method="POST" action="{{ url('/kirim/edit/'.$kirims->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ $kirims->nama }}">
                            </div>

                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Biaya &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="number" id="biaya" name="biaya" min="0" required class="form-control" value="{{ $kirims->biaya }}">
                            </div>

                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Durasi &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="number" id="durasi" name="durasi" min="0" required class="form-control" value="{{ $kirims->durasi }}">
                                <span class="input-group-text">Hari</span>
                            </div>

                            <button type="submit" class="btn btn-success float-right mt-5" onclick="return confirm('Ubah?')">
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
