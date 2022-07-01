@extends('layouts.main')

@section('title', '| Pembayaran')

@section('class5', 'nav-item active')

@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
       <div class="row">
          <div class="col-md-12">
             <div class="full">
                <h3>Pembayaran</h3>
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Biaya</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if(!empty($metodes))
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($metodes as $metode)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $metode->nama }}</td>
                                    <td>Rp. {{ number_format( $metode->biaya ) }}</td>
                                    <td>
                                        <a href="{{ url('/metode/edit/'.$metode->id) }}">
                                        <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ url('/metode/hapus/'.$metode->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
