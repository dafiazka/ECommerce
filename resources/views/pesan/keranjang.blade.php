@extends('layouts.main')

@section('title', '| Keranjang')

@section('class6', '| nav-item active')

@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
       <div class="row">
          <div class="col-md-12">
             <div class="full">
                <h3>Keranjang</h3>
             </div>
          </div>
       </div>
    </div>
</section>

<section class="product_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-12">
                <div class="box">
                    <div class="detail-box">
                    @if(!empty($keranjang->sub_total ) || !empty($keranjang->harga_total ))
                    <table class="table table-striped mt-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Per Meter</th>
                                <th>Sub Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($pembayarans as $pembayaran)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pembayaran->barang->nama_barang }}</td>
                                <td>{{ $pembayaran->jumlah_barang }} Meter</td>
                                <td>Rp. {{ number_format( $pembayaran->barang->harga ) }}</td>
                                <td>Rp. {{ number_format ( $pembayaran->jumlah_harga ) }}</td>
                                <td>
                                    <form action="{{ url('keranjang/hapus/'.$pembayaran->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if (!empty($keranjang))
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="1"><strong> Pengiriman </strong></td>
                                <td>
                                    <form action="{{ url('/keranjang/kirim', $keranjang->id) }}" method="POST">
                                        @csrf
                                        <select name="id_kirims" id="id_kirims" class="custom-select " onchange="this.form.submit();" required>
                                            <option value="{{ null }}"> Pilih </option>
                                            @foreach ($kirims as $kirim)
                                                <option value="{{ $kirim->id }}" {{ old('id_kirims', $keranjang->id_kirims) == $kirim->id ? 'selected' : '' }}> {{ $kirim->nama }} </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    @if (!empty($keranjang->id_kirims))
                                    Rp. {{ number_format( $keranjang->kirim->biaya ) }}
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="1"><strong> Metode </strong></td>
                                <td>
                                    <form action="{{ url('/keranjang/metode', $keranjang->id) }}" method="POST">
                                        @csrf
                                        <select name="id_metodes" id="id_metodes" class="custom-select " onchange="this.form.submit();" required @if(empty($keranjang->id_kirims)) disabled @endif>
                                            <option value="{{ null }}"> Pilih </option>
                                            @foreach ($metodes as $metode)
                                                <option value="{{ $metode->id }}" {{ old('id_metodes', $keranjang->id_metodes) == $metode->id ? 'selected' : '' }}> {{ $metode->nama }} </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    @if (!empty($keranjang->id_metodes))
                                    Rp. {{ number_format( $keranjang->metode->biaya ) }}
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="4" align="right"><strong> = </strong></td>
                                <td><strong>Rp. {{ number_format($keranjang->harga_total) }}</strong></td>
                                <td>
                                    <a href="{{ url('/checkout') }}" onclick="return confirm('Checkout?');">
                                        <button class="btn btn-success" @if(empty($keranjang->id_metodes)) disabled @endif>
                                            Check Out
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
