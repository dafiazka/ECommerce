@extends('layouts.main')

@section('title', '| Product Add')

@section('class2', 'nav-item active')

@section('content')
<section class="product_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-7">
                <div class="box">
                    <div class="detail-box">
                        <form method="POST" action="{{ url('/barang/edit', $barangs->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="text" id="nama_barang" name="nama_barang" required class="form-control" value="{{ $barangs->nama_barang }}" >
                            </div>

                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Deskripsi &nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <textarea id="deskripsi" type="text" name="deskripsi" required cols="130" rows="5" class="form-control">{{ $barangs->deskripsi }}</textarea>
                            </div>

                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Stok &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="number" id="stok" name="stok" required min="1" required class="form-control" value="{{ $barangs->stok }}" >
                            </div>

                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Harga &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <input type="number" id="harga" name="harga" required min="1" required class="form-control" value="{{ $barangs->harga }}" >
                            </div>

                            <div class="input-group row mb-3">
                                <h5 style="color: #f5a280">
                                    Gambar &nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h5>
                                <div class="custom-file">
                                    <input type="file" id="gambar" name="gambar" class="custom-file-input" onchange="PreviewImage();">
                                    <label class="custom-file-label" for="gambar"></label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success float-right mt-5" onclick="return confirm('Tambah Barang?')">
                                <i class="fa fa-save"></i>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-5">
                <div class="box">
                    <center>
                        <img id="uploadPreview" src="{{ asset('images/post/'.$barangs->gambar) }}" style="max-width: 100%; max-height: 408px;">
                    </center>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jquery Preview -->
<script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("gambar").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };

</script>
@endsection
