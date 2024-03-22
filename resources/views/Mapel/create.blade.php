@extends('adminlte::page')
@section('title', 'Tambah Mapel')
@section('content_header')
    <h1 class="m-0 text-dark">Tambah Mapel</h1>
@stop
@section('content')
    <form action="{{route('mapel.store')}}" method="post">
     @csrf
     <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="mapel">Mapel</label>
                        <input type="text" class="form-control
@error('mapel') is-invalid @enderror" id="mapel"
placeholder="Mapel" name="mapel"
value="{{old('mapel')}}">
                        @error('mapel') <span class="textdanger">{{$message}}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kompetensikeahlian">Kompetensi Keahlian</label>
                        <div class="input-group">
                            <input type="hidden" name="kdkompkeahlian" id="kdkompkeahlian" value="{{old('kdkompkeahlian')}}">
                            <input type="text" class="form-control
@error('kompetensikeahlian') is-invalid @enderror" placeholder="Kompetensi Keahlian"
id="kompetensikeahlian" name="kompetensikeahlian" value="{{old('kompetensikeahlian')}}" arialabel="Kompetensi Keahlian" aria-describedby="cari" readonly>
                            <button class="btn btn-warning" type="button"
data-bs-toggle="modal" id="cari" data-bs-target="#staticBackdrop"></i>
Cari Data Standar Kompetensi</button>
                      </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('mapel.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bsbackdrop="static" data-bs-keyboard="false" tabindex="-1" arialabelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable p-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5"
id="staticBackdropLabel">Pencarian Data Standar Kompetensi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-hover table-bordered tablestripped" id="example2">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kompetensi Keahlian</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($jurusan as $key => $jr)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td id={{$key+1}}>{{$jr->kompetensikeahlian}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-xs" onclick="pilih('{{$jr->id}}', '{{$jr->kompetensikeahlian}}')" data-bs-dismiss="modal">
                                    Pilih
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@stop

@push('js')
 <script>
    $('#example2').DataTable({
        "responsive": true,
 });
 //Fungsi pilih untuk memilih data Standar Kompetensi dan mengirimkan data Standar Kompetensi dari Modal ke form tambah
 function pilih(id, jurusan){
    document.getElementById('kdkompkeahlian').value = id
    document.getElementById('kompetensikeahlian').value = jurusan
 }
 </script>
@endpush