@extends('layouts.admin_app')

@section('title', 'Certificate List')

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Certificate List</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Certificate</li>
            </ol>
        </div>
    </div>
@endsection

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <a href="{{ route('certificate.create') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus-circle"></i> Add New Certificate
                    </a>
                </div>
                <div class="card-body">
                    <table id="certificateTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>BRTC No</th>
                                <th>Ref No</th>
                                <th>Date of Test</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            let table = $('#certificateTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('certificate.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'brtc_no', name: 'brtc_no' },
                    { data: 'ref_no', name: 'ref_no' },
                    { data: 'date_of_test', name: 'date_of_test' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' },
                ]
            });

            // Handle Delete
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let url = "{{ route('certificate.delete') }}";

                if (confirm('Are you sure you want to delete this certificate?')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: { id: id, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Certificate deleted successfully!');
                                table.ajax.reload();
                            } else {
                                toastr.error('Something went wrong!');
                            }
                        },
                        error: function() {
                            toastr.error('Unable to delete certificate.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
