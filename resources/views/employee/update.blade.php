@extends('layout.app')

@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection


@section('breadcrumb')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Karyawan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</div>
<form method="POST" action="{{route('employee.update.field', $data->id)}}" enctype="multipart/form-data">

   @csrf
   @method('PUT')

   <div class="card p-5">
      <div class="row mb-3">
         <div class="col-4">
            
            <select class="form-select" aria-label="Default select example" name="position_id">
               @foreach ($position as $item)
                <option value="{{$item->id}}" {{$item->id == $data->position->id? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
               </select>
            </div>
            <div class="col-4">
               
               <input class="form-control" value="{{$data->name}}" type="text" placeholder="Name" name="name" aria-label="default input example">
            </div>
            <div class="col-4">
               
               <input class="form-control" value="{{$data->NIP}}" type="text" placeholder="NIP" name="nip" aria-label="default input example">
            </div>
         </div>
         
    <div class="row my-2">
       <div class="col-6">
          
          @php
            $year = [];
            
            for($i = 1970; $i<=2024; $i++) { array_push($year, $i); } @endphp 
            
            <select class="form-select"
                aria-label="Default select example" name="tahun_lahir">
                @foreach ($year as $item)
                <option value="{{$item}}" {{$data->tahun_lahir == $item? 'selected' :  ''}}>{{$item}}</option>
                @endforeach
               </select>
            </div>
        <div class="col-6">

            <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" placeholder="Alamat" rows="3">{{$data->alamat}}</textarea>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-6">
           
           <input name="no_telp" type="text" id="numericInput" onkeypress="return isNumberKey(event)" class="form-control" type="text"
           placeholder="Nomer Telpon" value="{{$data->no_telp}}" aria-label="default input example">
         </div>
         
         <div class="col-6">
            <label>Agama :</label>
            
            <div class="form-check">
               <input class="form-check-input" type="radio" value="Islam" name="agama" id="agama1" {{$data->agama == "Islam"? 'checked' : ''}}>
               <label class="form-check-label" for="agama1">
                  Islam
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" value="Kristen" name="agama" id="agama2" {{$data->agama == "Kristen"? 'checked' : ''}}>
               <label class="form-check-label" for="agama2">
                  Kristen
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" type="radio" value="Khatolik" name="agama" id="agama3" {{$data->agama == "Khatolik"? 'checked' : ''}}>
               <label class="form-check-label" for="agama3">
                    Khatolik
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Hindu" name="agama" id="agama4" {{$data->agama == "Hindu"? 'checked' : ''}}>
                <label class="form-check-label" for="agama4">
                    Hindu
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="Buddha" name="agama" id="agama5" {{$data->agama == "Buddha"? 'checked' : ''}}>
                <label class="form-check-label" for="agama5">
                   Buddha
                  </label>
               </div>
            </div>
    </div>
    <div class="mt-3">
      <label for="formFile" class="form-label">Upload Image</label>
      <input id="fileInput" class="form-control" value="E:\code\aGFja3RpdmU4\tect-test-pilar\fullstack-developer-technical-test\public\images\1711613018_KTP_Supiatun.png" name="path_image" type="file" id="formFile" accept="image/png, image/jpeg">
      <div class="mt-3">
         <span>Current File: </span> <img src="{{ asset('images/'.$data->path_image) }}" style="max-height: 100px; max-width: 150px;"></img>
      </div>


      {{-- <script>
         // Get a reference to our file input
         const fileInput = document.querySelector('input[type="file"]');
         // var employeeId = {{ $imgPath }};
         // console.log($imgPath);
         // Create a new File object
         const myFile = new File(['Hello World!'], 'E:\code\aGFja3RpdmU4\tect-test-pilar\fullstack-developer-technical-test\public\images\1711613018_KTP_Supiatun.png', {
             type: 'image/png, image/jpeg',
             lastModified: new Date(),
         });
         // Now let's create a DataTransfer to get a FileList
         const dataTransfer = new DataTransfer();
         dataTransfer.items.add(myFile);
         fileInput.files = dataTransfer.files;
      </script> --}}
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
