<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\KompetensiKeahlian;

class MapelController extends Controller
{
    // menampilkan data Mapel
    public function index(){
        $mapel = Mapel::all();
        return view('mapel.index', [
            'mapel' => $mapel
        ]);
    }

    //menambah data Mapel
    public function create(){
        return view(
            'mapel.create', [
            'jurusan' => KompetensiKeahlian::all() 
        ]);
    }    
    public function store(Request $request){
        $request->validate([
            'mapel' =>'required|unique:mapel,mapel',
            'kdkompkeahlian'=> 'required'
    ]);
     $array = $request->only([
        'mapel', 'kdkompkeahlian'
    ]);
    $mapel = Mapel::create($array);
    return redirect()->route('mapel.index')
        ->with('success_message', 'Berhasil menambah mapel baru');
    }  
    public function edit($id)
    {
    //Menampilkan Form Edit mapel
    $mapel = Mapel::find($id);
    if (!$mapel) return redirect()->route('mapel.index')
    ->with('error_message', 'Mapel dengan id = '.$id.'tidak ditemukan');
    return view('mapel.edit', [
        'mapel' => $mapel,
        'jurusan' => KompetensiKeahlian::all() 
        //Mengirimkan semua databidang studi ke Modal pada halaman edit
    ]);
    }
    public function update(Request $request, $id){
    //Mengedit Data Mapel
    $request->validate([
        'mapel' =>'required|unique:mapel,mapel,'.$id
    ]);
    $mapel = Mapel::find($id);
    $mapel->mapel = $request->mapel;
    $mapel->kdkompkeahlian = $request->kdkompkeahlian;
    $mapel->save();
    return redirect()->route('mapel.index')
        ->with('success_message', 'Berhasil mengubah Mapel');
    } 
    public function destroy(Request $request, $id)
    {
        //Menghapus standar Mapel
        $mapel = Mapel::find($id);
        if ($mapel) $mapel->delete();
        return redirect()->route('mapel.index')
            ->with('success_message', 'Berhasil menghapus Mapel "' . $mapel->mapel . '" !');
    } 
}