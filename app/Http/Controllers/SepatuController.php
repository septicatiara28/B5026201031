<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SepatuController extends Controller
{
    public function index()
    {
    	// mengambil data dari sepatu
    	//$sepatu = DB::table('sepatu')->get();
        $sepatu = DB::table('sepatu')->paginate(5);

    	// mengirim data sepati ke view index
    	return view('sepatu.index',['sepatu' => $sepatu]);

    }
    // method untuk menampilkan view form tambah sepatu
    public function tambah()
    {

        // memanggil view tambah
        return view('sepatu.tambah');

    }
    // method untuk insert data ke table sepatu
    public function store(Request $request)
    {
    // insert data ke table sepatu
    DB::table('sepatu')->insert([
        'kodesepatu' => $request->kode,
        'merksepatu' => $request->merk,
        'stocksepatu' => $request->stock,
        'tersedia'=> $request->tersedia
    ]);
    // alihkan halaman ke halaman sepatu
    return redirect('/sepatu');
    }
     // method untuk edit data sepatu
     public function edit($id)
     {
         // mengambil data sepatu berdasarkan id yang dipilih
         $sepatu = DB::table('sepatu')->where('kodesepatu',$id)->get();
         // passing data sepatu yang didapat ke view edit.blade.php
         return view('sepatu.edit',['sepatu' => $sepatu]);

     }
     public function view($id)
     {
         // mengambil data sepatu berdasarkan id yang dipilih
         $sepatu = DB::table('sepatu')->where('kodesepatu',$id)->get();
         // passing data sepatu yang didapat ke view edit.blade.php
         return view('sepatu.detail',['sepatu' => $sepatu]);

     }
     // update data sepatu
     public function update(Request $request)
     {
         // update data sepatu
         DB::table('sepatu')->where('kodesepatu',$request->id)->update([
             'kodesepatu' => $request->kode,
             'merksepatu' => $request->merk,
             'stocksepatu' => $request->stock,
             'tersedia' => $request->tersedia
         ]);
         // alihkan halaman ke halaman sepatu
         return redirect('/sepatu');
     }
        // method untuk hapus data sepatu
    public function hapus($id)
    {
        // menghapus data pegawai berdasarkan id yang dipilih
        DB::table('sepatu')->where('kodesepatu',$id)->delete();

        // alihkan halaman ke halaman sepatu
        return redirect('/sepatu');
    }
    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table sepatu sesuai pencarian data
        $sepatu = DB::table('sepatu')
        ->where('merksepatu','like',"%".$cari."%")
        ->paginate();

            // mengirim data sepatu ke view index
        return view('sepatu.index',['sepatu' => $sepatu]);

    }

}
