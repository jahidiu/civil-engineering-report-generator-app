@extends('layouts.admin_app')

@section('title', 'Signatory List')

@section('breadcrumb')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Signatory List</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Signatories</li>
        </ol>
    </div>
</div>
@endsection

@section('page-content')
<div class="row">
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-header">
                <a href="{{ route('signatory.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Add New
                </a>
            </div>

            <div class="card-body">
                <table id="signatoryTable" class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Institute</th>
                            <th>Role</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function () {
        $('#signatoryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('signatory.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'designation', name: 'designation' },
                { data: 'department', name: 'department' },
                { data: 'institute', name: 'institute' },
                { data: 'role', name: 'role' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
