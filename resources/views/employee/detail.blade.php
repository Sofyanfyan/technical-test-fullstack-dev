@extends('layout.app')

@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection


@section('breadcrumb')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Karyawan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
        <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
</div>
<div class="card p-5 mb-5">

   <h6>Position : </h6> <p>{{$data->position->name}}</p>
   <h6>Nama :</h6> <p>{{$data->name}}</p>
   <h6>NIP :</h6> <p>{{$data->NIP}}</p>
   <h6>Tahun lahir :</h6>  <p>{{$data->tahun_lahir}}</p>
   <h6>Alamat :</h6>  <p>{{$data->alamat}}</p>
   <h6>Nomer Telp :</h6>  <p>{{$data->nomer_telp}}</p>
   <h6>Agama :</h6>  <p>{{$data->agama}}</p>
   <h6>Status :</h6> {{$data->status? 'Active' : 'Inactive'}}
   <h6 class="mt-5">Image KTP :</h6>  <img src="{{ asset('images/'.$data->path_image) }}" style="max-height: 200px; max-width: 300px;"></img>
</div>

@endsection