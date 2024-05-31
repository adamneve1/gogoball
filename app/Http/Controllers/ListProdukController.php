<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

use Illuminate\Support\Facades\Response;


class ListProdukController extends Controller
{
    public function show()
    {
        $data = Produk::all();

        // Initialize arrays
        $nama = [];
        $desc = [];
        $harga = [];

        foreach ($data as $produk) {
            $nama[] = $produk->nama;
            $desc[] = $produk->deskripsi;
            $harga[] = $produk->harga;
        }

        return view('list_produk', compact('nama', 'desc', 'harga'));
    }

    public function simpan(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
        ]);

        // Create a new product instance
        $produk = new Produk;
        $produk->nama = $request->input('nama');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->harga = $request->input('harga');
        $produk->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data Berhasil Disimpan!');
    }

    public function delete($id){
        if ($produk){
            $produk->delete();
            return redirect()->back()->with('success', 'Produk Berhasil Dihapus');
        }else{
            return redirect()->back()->with('error', 'Produk Tidak Ditemukan');
        }
    }
    public function showApi()
    {
        $produk = Produk::all();

        return Response::json([
            'data' => $produk
        ]);
    }
    
    
}

