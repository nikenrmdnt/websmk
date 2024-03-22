<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KompetensiKeahlian;
use App\Models\StandarKompetensi;

class KompetensiKeahlianController extends Controller
{
    // menampilkan data kompetensi keahlian
    public function index(){
        $jurusan = KompetensiKeahlian::all();
        return view('kompetensikeahlian.index', [
            'jurusan' => $jurusan
        ]);
    }

    //menambah data kompetensi keahlian
    public function create(){
        return view(
            'kompetensikeahlian.create', [
            'standkomp' => StandarKompetensi::all() 
        ]);
    }    
    public function store(Request $request){
        $request->validate([
            'kompetensikeahlian' =>'required|unique:kompetensikeahlian,kompetensikeahlian',
            'kdstandkomp'=> 'required'
    ]);
     $array = $request->only([
        'kompetensikeahlian', 'kdstandkomp'
    ]);
    $jurusan = KompetensiKeahlian::create($array);
    return redirect()->route('jurusan.index')
        ->with('success_message', 'Berhasil menambah kompetensi
        keahlian baru');
    }  
    public function edit($id)
    {
    //Menampilkan Form Edit kompetensi keahlian
    $jurusan = KompetensiKeahlian::find($id);
    if (!$jurusan) return redirect()->route('jurusan.index')
    ->with('error_message', 'Kompetensi Keahlian dengan id = '.$id.'tidak ditemukan');
    return view('kompetensikeahlian.edit', [
        'jurusan' => $jurusan,
        'standkomp' => StandarKompetensi::all() 
        //Mengirimkan semua databidang studi ke Modal pada halaman edit
    ]);
    }
    public function update(Request $request, $id){
    //Mengedit Data Kompetensi Keahlian
    $request->validate([
        'kompetensikeahlian' =>'required|unique:kompetensikeahlian,kompetensikeahlian,'.$id
    ]);
    $jurusan = KompetensiKeahlian::find($id);
    $jurusan->kompetensikeahlian = $request->kompetensikeahlian;
    $jurusan->kdstandkomp = $request->kdstandkomp;
    $jurusan->save();
    return redirect()->route('jurusan.index')
        ->with('success_message', 'Berhasil mengubah Kompetensi Keahlian');
    } 
    public function destroy(Request $request, $id)
    {
        //Menghapus standar kompetensi keahlian
        $jurusan = KompetensiKeahlian::find($id);
        if ($jurusan) $jurusan->delete();
        return redirect()->route('jurusan.index')
            ->with('success_message', 'Berhasil menghapus Kompetensi Keahlian "' . $jurusan->kompetensikeahlian . '" !');
    } 
}