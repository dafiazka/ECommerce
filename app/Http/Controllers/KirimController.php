<?php

namespace App\Http\Controllers;

use App\Models\Kirim;
use Illuminate\Http\Request;

class KirimController extends Controller
{
    public function index()
    {
        $kirims = Kirim::all();

        return view('kirim.index', compact('kirims'));
    }

    public function add()
    {
        return view('kirim.add');
    }

    public function addprocess(Request $request)
    {
        $request->validate = ([
            'nama' => ['required'],
            'biaya' => ['required', 'interger'],
            'durasi' => ['required', 'interger']
        ]);

        $post = new Kirim;
        $post->nama = $request->nama;
        $post->biaya = $request->biaya;
        $post->durasi = $request->durasi;
        $post->save();

        return redirect('kirim')->with('status', 'Pengiriman Ditambah!');
    }

    public function edit($id)
    {
        $kirims = Kirim::where('id', $id)->first();

        return view('kirim.edit', compact('kirims'));
    }

    public function editprocess(Request $request, $id)
    {
        $post = Kirim::findorfail($id);
        $post->nama = $request->nama;
        $post->biaya = $request->biaya;
        $post->durasi = $request->durasi;
        $post->update();

        return redirect('kirim')->with('status', 'Pengiramn Diubah!');
    }

    public function destroy($id)
    {
        Kirim::where('id', $id)->delete();
        return back()->with('status', 'Pengiriman Dihapus!');
    }
}

