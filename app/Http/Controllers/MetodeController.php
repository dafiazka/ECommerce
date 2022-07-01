<?php

namespace App\Http\Controllers;

use App\Models\Metode;
use Illuminate\Http\Request;

class MetodeController extends Controller
{
    public function index()
    {
        $metodes = Metode::all();

        return view('metode.index', compact('metodes'));
    }

    public function add()
    {
        return view('metode.add');
    }

    public function addprocess(Request $request)
    {
        $request->validate = ([
            'nama' => ['required'],
            'biaya' => ['required', 'interger']
        ]);

        $post = new Metode;
        $post->nama = $request->nama;
        $post->biaya = $request->biaya;
        $post->save();

        return redirect('metode')->with('status', 'Pembayaran Ditambah!');
    }

    public function edit($id)
    {
        $metodes = Metode::where('id', $id)->first();

        return view('metode.edit', compact('metodes'));
    }

    public function editprocess(Request $request, $id)
    {
        $post = Metode::findorfail($id);
        $post->nama = $request->nama;
        $post->biaya = $request->biaya;
        $post->update();

        return redirect('metode')->with('status', 'Pembayaran Diubah!');
    }

    public function destroy($id)
    {
        Metode::where('id', $id)->delete();
        return back()->with('status', 'Pembayaran Dihapus!');
    }
}
