@extends('layout.app')

@section('css')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Jabatan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
    </ol>
</div>
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<a class="btn btn-success mb-5" role="button" href="{{ route('employee.create') }}">
    <span>Add Employee</span>
</a>
<div class="card sm mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@if (session('after_create')){
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "Signed in successfully"
    });

</script> 
}

@endif

<script>
     function deleteEmployee(id) {
        var confirmation = confirm("Are you sure you want to delete this employee?");
        if (confirmation) {
        let token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: '/employee/' + id,
                type: 'delete',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                        id: id,
                        _token: token,
               },
                success: function(result) {
                   console.log("Employee deleted successfully.");
                   location.reload();
                },
                error: function(err) {
                    alert('Internal service error!');
                    console.error("Error deleting employee: " + err.responseText);
                }
            });
        }
    }
     function changeStatus(id) {
        var confirmation = confirm("Are you sure you want to update this employee?");
        if (confirmation) {
        let token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: '/employee/' + id,
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                        id: id,
                        _token: token,
               },
                success: function(result) {
                   console.log("Employee update status success");
                   location.reload();
                },
                error: function(err) {
                    alert('Internal service error!');
                    console.error("Employee update status error: " + err.responseText);
                }
            });
        }
    }
</script>

@endsection

@push('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('employee.index') }}",
        columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: "text-center"
            },
            {
                data: 'name'
            },
            {
                data: function (row) {
                    return row.position.name;
                },
                name: 'position.name',
            },
            {
               data: null,
               orderable: false,
               searchable: false,
               render: function (data, type, full, meta) {

                  let status =  full.status == 1? "Active" : "Inactive"
                    return '<button onclick="changeStatus(' + full.id + ')" class="btn btn-secondary me-1">'+ status +'</button>';
                },
            },
            { 
               data: null,
               orderable: false,
               searchable: false,
               render: function(data, type, full, meta) {
                  var detailUrl = '{{ route("employee.show", ":id") }}'.replace(':id', full.id);
                  var deleteUrl = '{{ route("employee.destroy", ":id") }}'.replace(':id', full.id);
                   return '<a href="{{route('employee.create')}}" class="btn btn-primary me-1">Edit</a>| <button onclick="deleteEmployee(' + full.id + ')" class="btn btn-danger me-1">Delete</button> | <a href="' + detailUrl + '" class="btn btn-warning me-1">Detail</a>';
               }
            },
        ]
    })

</script>


@endpush
