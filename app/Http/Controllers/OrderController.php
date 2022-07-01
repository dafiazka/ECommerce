<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Kirim;
use App\Models\Metode;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detail($id)
    {
        $barang = Barang::where('id', $id)->first();

        return view('pesan.info', compact('barang'));

    }

    public function keranjang(Request $request, $id)
    {
        //ambil data dan fasilitas
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        //validasi stok apakah jumlah barang yang dipesan lebih atau kurang dari stok
        if($request->jumlah_barang > $barang->stok || $request->jumlah_barang < 0){
            return redirect('order/'.$id)->with('status_bayar', 'Barang Melebihi Stok');
        }

        //validasi data dari tabel keranjang
        $cek_keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();

        //Simpan ke table keranjang jika kosong
        if(empty($cek_keranjang)){
            $keranjang = new Keranjang;
            $keranjang->id_users = Auth::user()->id;
            $keranjang->jumlah_barang = $request->jumlah_barang;
            $keranjang->sub_total = $barang->harga * $request->jumlah_barang;
            $keranjang->harga_total = $keranjang->sub_total;
            $keranjang->tanggal = $tanggal;
            $keranjang->status_bayar = 'belum_bayar';
            $keranjang->save();
        }

        //update ke table keranjang jika ada isinya
        else{
            $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();
            $keranjang->jumlah_barang = $keranjang->jumlah_barang + $request->jumlah_barang;
            $keranjang->sub_total = $keranjang->sub_total + $request->jumlah_barang * $barang->harga;
            $keranjang->tanggal = $tanggal;
            if (!empty($keranjang->id_kirims)) {
                $keranjang->harga_total = $keranjang->sub_total + $keranjang->kirim->biaya;
            }
            else {
                $keranjang->harga_total = $keranjang->sub_total;
            }
            $keranjang->update();
        }


        //deklarasi baru keranjang & pembayaran yang sudah diupdate
        $keranjang_2 = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();


        //validasi data dari table pembayaran yang sudah diupdate
        $cek_pembayaran = Pembayaran::where('id_barangs', $barang->id)->where('id_keranjangs', $keranjang_2->id)->first();

        //simpan ke table pembayaran jika kosong
        if (empty($cek_pembayaran)) {
            $pembayaran = new Pembayaran;
            $pembayaran->id_barangs = $barang->id;
            $pembayaran->id_keranjangs = $keranjang_2->id;
            $pembayaran->jumlah_barang = $request->jumlah_barang;
            $pembayaran->jumlah_harga = $barang->harga * $request->jumlah_barang;
            $pembayaran->save();
        }

        //update ke table pembayaran jika ada isinya
        else{
            $pembayaran = Pembayaran::where('id_barangs', $barang->id)->where('id_keranjangs', $keranjang_2->id)->first();
            $pembayaran->jumlah_barang = $pembayaran->jumlah_barang + $request->jumlah_barang;
            $pembayaran->jumlah_harga = $pembayaran->jumlah_harga + $request->jumlah_barang * $barang->harga ;
            $pembayaran->update();
        }

        return redirect('keranjang')->with('status', 'Barang Dimasukan ke Keranjang');

        // dd($request);
    }

    public function checkout()
    {
        $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();
        $kirims = Kirim::get();
        $metodes = Metode::get();
        $pembayarans = [];
        if (!empty($keranjang)) {
            $pembayarans = Pembayaran::where('id_keranjangs', $keranjang->id)->get();
        }

        return view('pesan.keranjang', compact('keranjang', 'pembayarans', 'kirims', 'metodes' ));

        // dd($pembayarans);
    }

    public function kiriminsert(Request $request)
    {
        $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();
        $keranjang->id_kirims = $request->id_kirims;
        if ($request->id_kirims == null)
        {
            $keranjang->id_kirims = null;
            $keranjang->harga_total = $keranjang->sub_total;
        }
        else
        {
            $keranjang2 = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();
            $keranjang->id_kirims = $request->id_kirims;
            if (!empty($keranjang->id_metodes)) {
                $keranjang->harga_total = $keranjang2->sub_total + $keranjang->kirim->biaya + $keranjang->metode->biaya;
            }
            else {
                $keranjang->harga_total = $keranjang2->sub_total + $keranjang->kirim->biaya;
            }
        }
        $keranjang->update();

        return redirect('keranjang')->with('status', 'Pengiriman Di Update');
    }

    public function metodeinsert(Request $request)
    {
        $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();
        $keranjang->id_metodes = $request->id_metodes;
        if ($request->id_metodes == null)
        {
            $keranjang->id_metodes = null;
            $keranjang->harga_total = $keranjang->sub_total + $keranjang->kirim->biaya;
        }
        else
        {
            $keranjang->id_metodes = $request->id_metodes;
            $keranjang->harga_total = $keranjang->sub_total + $keranjang->kirim->biaya + $keranjang->metode->biaya;
        }
        $keranjang->update();

        return redirect('keranjang')->with('status', 'Pembayaran Di Update');
    }

    public function konfirmasi_checkout()
    {
        $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'belum_bayar')->first();
        $pembayarans = Pembayaran::where('id_keranjangs', $keranjang->id)->get();
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $acak = substr(str_shuffle($karakter), 0, 15);

        //Jika Kirim dan Metode kosong
        if ($keranjang->id_kirims == null && $keranjang->id_metodes == null) {
            return back();
        }

        elseif ($keranjang->id_kirims == null && $keranjang->metodes->nama == ['cod' || 'COD']) {
            //Menambah Kode
            $keranjang->kode = $acak;

            //update status
            $keranjang->status_bayar = 'sudah_bayar';
            $keranjang->update();

            //update stok
            foreach ($pembayarans as $pembayaran) {
                $barang = Barang::where('id', $pembayaran->id_barangs)->first();
                $barang->stok = $barang->stok - $pembayaran->jumlah_barang;
                $barang->update();
                // $pembayaran->delete();
            }

            return redirect('/histori/nota/'. $keranjang->id);
        }
        
        //Menambah Kode
        $keranjang->kode = $acak;

        //update status
        $keranjang->status_bayar = 'sudah_bayar';
        $keranjang->update();

        //update stok
        foreach ($pembayarans as $pembayaran) {
            $barang = Barang::where('id', $pembayaran->id_barangs)->first();
            $barang->stok = $barang->stok - $pembayaran->jumlah_barang;
            $barang->update();
            // $pembayaran->delete();
        }

        return redirect('/histori/nota/'. $keranjang->id);

    }

    public function histori()
    {
        $historis = Keranjang::where('id_users', Auth::user()->id)->where('status_bayar', 'sudah_bayar')->get();

        return view('pesan.histori', compact('historis'));
        // dd($historis);
    }

    public function nota($id)
    {
        $keranjang = Keranjang::where('id_users', Auth::user()->id)->where('id', $id)->where('status_bayar', 'sudah_bayar' )->first();
        $pembayarans = [];
        if (!empty($keranjang)) {
            $pembayarans = Pembayaran::where('id_keranjangs', $keranjang->id)->get();
        }

        return view('pesan.nota', compact('keranjang', 'pembayarans'));

        // dd($pembayarans);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->first();

        //update jumlah barang dan harga total di tabel keranjang saat menghapus data pembayaran
        $keranjang = Keranjang::where('id', $pembayaran->id_keranjangs)->first();
        $keranjang->jumlah_barang = $keranjang->jumlah_barang - $pembayaran->jumlah_barang;
        $keranjang->sub_total = $keranjang->sub_total - $pembayaran->jumlah_harga;
        $keranjang->harga_total = $keranjang->harga_total - $pembayaran->jumlah_harga;
        if (empty($keranjang->sub_total)) {
            $keranjang->id_kirims = null;
            $keranjang->harga_total = 0;
            $keranjang->tanggal = null;
        }
        $keranjang->update();

        $pembayaran->delete();

        return redirect('keranjang')->with('status', 'Barang Berhasil Dihapus');
    }
}
