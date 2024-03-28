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
<form method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data">

   @csrf
   @method('POST')

   <div class="card p-5">
      <div class="row mb-3">
         <div class="col-4">
            
            <select class="form-select" aria-label="Default select example" name="position_id">
               <option disabled selected>Pilih posisi</option>
               @foreach ($position as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
               </select>
            </div>
            <div class="col-4">
               
               <input class="form-control" type="text" placeholder="Name" name="name" aria-label="default input example">
            </div>
            <div class="col-4">
               
               <input class="form-control" type="text" placeholder="NIP" name="nip" aria-label="default input example">
            </div>
         </div>
         
    <div class="row my-2">
       <div class="col-6">
          
          @php
            $year = [];
            
            for($i = 1970; $i<=2024; $i++) { array_push($year, $i); } @endphp 
            
            <select class="form-select"
                aria-label="Default select example" name="tahun_lahir">
                <option disabled selected>Pilih Tahun Kelahiran</option>
                @foreach ($year as $item)
                <option value="{{$item}}">{{$item}}</option>
                @endforeach
               </select>
            </div>
        <div class="col-6">

            <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" placeholder="Alamat" rows="3"></textarea>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-6">
           
           <input name="no_telp" type="text" id="numericInput" onkeypress="return isNumberKey(event)" class="form-control" type="text"
           placeholder="Nomer Telpon" aria-label="default input example">
         </div>
         
         <div class="col-6">
            <label>Agama :</label>
            
            <div class="form-check">
               <input class="form-check-input" type="radio" value="Islam" name="agama" id="agama1" checked>
               <label class="form-check-label" for="agama1">
                  Islam
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" value="Kristen" name="agama" id="agama2">
               <label class="form-check-label" for="agama2">
                  Kristen
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" value="Khatolik" name="agama" id="agama3">
               <label class="form-check-label" for="agama3">
                    Khatolik
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Hindu" name="agama" id="agama4">
                <label class="form-check-label" for="agama4">
                    Hindu
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Buddha" name="agama" id="agama5">
                <label class="form-check-label" for="agama5">
                   Buddha
                  </label>
               </div>
            </div>
    </div>
    
    <div class="mt-3">
      <label for="formFile" class="form-label">Upload Image</label>
      <input class="form-control" name="path_image" type="file" id="formFile" accept="image/png, image/jpeg">
    </div>
</div>

   <input type="submit" role="button" value="Submit" class="btn btn-success w-100 my-5">

</form>


<script>
   function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

</script>
@endsection
