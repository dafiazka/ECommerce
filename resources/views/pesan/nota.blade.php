@extends('layouts.main')

@section('title', '| Histori')

@section('class4', 'nav-item active')

@section('content')

<section class="product_section">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($pembayarans as $pembayaran)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="box">
                    <div class="img-box">
                        <img src="{{ asset('images/post/'.$pembayaran->barang->gambar) }}" alt="">
                    </div>
                    <center>
                        {{ $pembayaran->barang->nama_barang }}
                    </center>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 col-lg-8 mb-5">
                <div class="box">
                    <center  class="mb-5">
                        <h3>
                            <b>{{ $keranjang->kode }}</b>
                        </h3>
                        <p>
                            Nomor Resi
                        </p>
                    </center>
                    <div class="detail-box">
                        <h5>Data Customer :</h5>
                    </div>
                    <div class="detail-box">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <td></td>
                                    <td>{{ $keranjang->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td></td>
                                    <td>{{ $keranjang->user->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td></td>
                                    <td>{{ $keranjang->user->nohp }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="detail-box">
                        <h5>Detail :</h5>
                    </div>
                    <div class="detail-box">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>Durasi</th>
                                    <td></td>
                                    <th>Total</th>
                                </tr>
                                <tr>
                                    <th>Jumlah Barang</th>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $keranjang->jumlah_barang }} Buah</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <?php $no = 1; ?>
                                    @foreach ($pembayarans as $pembayaran)
                                    <tr>
                                        <th>Barang - {{ $no++ }}</th>
                                        <td>{{ $pembayaran->barang->nama_barang }}</td>
                                        <td></td>
                                        <td>{{ $pembayaran->jumlah_barang }} Buah</td>
                                        <td>Rp. {{ number_format($pembayaran->jumlah_harga) }}</td>
                                    </tr>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>Pengiriman</th>
                                    <td>{{ $keranjang->kirim->nama }}</td>
                                    <td>{{ $keranjang->kirim->durasi }} Hari</td>
                                    <td></td>
                                    <td>Rp. {{ number_format($keranjang->kirim->biaya) }}</td>
                                </tr>
                                <tr>
                                    <th>Pembayaran</th>
                                    <td>{{ $keranjang->metode->nama }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>Rp. {{ number_format($keranjang->metode->biaya) }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong> = </strong> </td>
                                    <td><strong> Rp. {{ number_format($keranjang->harga_total) }}</strong></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
