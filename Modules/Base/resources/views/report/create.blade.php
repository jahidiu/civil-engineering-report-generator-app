@extends('layouts.admin_app')

@section('title', 'Report Create')

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Report Create</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </div>
    </div>
@endsection

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            {{-- BRTC No --}}
                            <x-common.input :required="true" column="6" type="text" id="brtc_no" name="brtc_no"
                                label="BRTC No" placeholder="Enter BRTC No (e.g. 1103-54536/CE/24-25)" :value="old('brtc_no')" />

                            {{-- BRTC Date --}}
                            <x-common.input :required="true" column="6" type="date" id="brtc_date" name="brtc_date"
                                label="BRTC Date" placeholder="Select BRTC Date" :value="old('brtc_date')" />

                            {{-- Reference No --}}
                            <x-common.input :required="false" column="6" type="text" id="ref_no" name="ref_no"
                                label="Reference No" placeholder="Enter Reference No" :value="old('ref_no')" />

                            {{-- Reference Date --}}
                            <x-common.input :required="false" column="6" type="date" id="ref_date" name="ref_date"
                                label="Reference Date" placeholder="Select Reference Date" :value="old('ref_date')" />

                            {{-- Sent By --}}
                            <x-common.input :required="true" column="12" type="text" id="sent_by" name="sent_by"
                                label="Sent By" placeholder="Enter Sender Name / Organization" :value="old('sent_by')" />

                            {{-- Sample Description --}}
                            <x-common.input :required="true" column="12" type="textarea" id="sample" name="sample"
                                label="Sample Description" placeholder="Enter Sample Description" :value="old('sample')" />

                            {{-- Project Name --}}
                            <x-common.input :required="true" column="6" type="text" id="project" name="project"
                                label="Project Name" placeholder="Enter Project Name" :value="old('project')" />

                            {{-- Location --}}
                            <x-common.input :required="true" column="6" type="text" id="location" name="location"
                                label="Location" placeholder="Enter Location (e.g. Floor Casting)" :value="old('location')" />

                            {{-- Test Name --}}
                            <x-common.input :required="true" column="6" type="text" id="test_name" name="test_name"
                                label="Test Name" placeholder="Enter Test Name (e.g. Compressive Strength Test)" :value="old('test_name')" />

                            {{-- QR Code ID --}}
                            <x-common.input :required="true" column="6" type="text" id="qr_code_id" name="qr_code_id"
                                label="QR Code ID" placeholder="Enter QR Code ID (e.g. 5Xg7htz7Z)" :value="old('qr_code_id')" />

                            {{-- Date of Test --}}
                            <x-common.input :required="true" column="6" type="date" id="date_of_test" name="date_of_test"
                                label="Date of Test" placeholder="Select Date of Test" :value="old('date_of_test')" />

                            {{-- Notes --}}
                            <x-common.text-area :required="false" column="6" id="notes" name="notes" row=1
                                label="Notes" placeholder="Enter Notes (e.g. Samples received sealed)" :value="old('notes')" />

                            {{-- Left Signatory --}}
                            <x-common.server-side-select :required="false" column=6 name="left_signatory_id" id="left_signatory_id"
                                class="left_signatory_id" disableOptionText="Select Left Signatory" label="Left Signatory"> </x-common.server-side-select>

                            {{-- Right Signatory --}}
                            <x-common.server-side-select :required="false" column=6 name="right_signatory_id" id="right_signatory_id"
                                class="right_signatory_id" disableOptionText="Select Right Signatory" label="Right Signatory"> </x-common.server-side-select>

                            {{-- Test Results Table --}}
                            <div class="col-12 mt-4">
                                <h5 class="mb-3">Test Results</h5>

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="testResultsTable">
                                        <thead class="table-light">
                                            <tr class="text-center align-middle">
                                                <th style="width: 15%;">Date of Casting</th>
                                                <th style="width: 10%;">Specimen</th>
                                                <th style="width: 10%;">Area (sq.in)</th>
                                                <th style="width: 15%;">Max Load (lb)</th>
                                                <th style="width: 15%;">Crushing Strength (psi)</th>
                                                <th style="width: 15%;">Average Strength</th>
                                                <th style="width: 15%;">Mode of Failure</th>
                                                <th style="width: 5%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input type="date" name="test_results[0][date_of_casting]" class="form-control"></td>
                                                <td><input type="text" name="test_results[0][specimen_designation]" class="form-control" placeholder="PA"></td>
                                                <td><input type="number" step="0.01" name="test_results[0][specimen_area]" class="form-control" placeholder="0.00"></td>
                                                <td><input type="number" step="0.01" name="test_results[0][maximum_load]" class="form-control" placeholder="0.00"></td>
                                                <td><input type="number" step="0.01" name="test_results[0][crushing_strength]" class="form-control" placeholder="0.00"></td>
                                                <td><input type="number" step="0.01" name="test_results[0][average_strength]" class="form-control" placeholder="0.00"></td>
                                                <td><input type="text" name="test_results[0][mode_of_failure]" class="form-control" placeholder="Combined"></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-sm removeRow">×</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-end mt-1">
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="addRow">
                                        <i class="fas fa-plus"></i> Add More
                                    </button>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="text-start mt-2">
                                <a href="{{ route('report.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Save
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let rowIndex = 1;

        // Add new row
        document.getElementById('addRow').addEventListener('click', function() {
            const tableBody = document.querySelector('#testResultsTable tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
            <td><input type="date" name="test_results[${rowIndex}][date_of_casting]" class="form-control"></td>
            <td><input type="text" name="test_results[${rowIndex}][specimen_designation]" class="form-control" placeholder="PA"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][specimen_area]" class="form-control" placeholder="0.00"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][maximum_load]" class="form-control" placeholder="0.00"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][crushing_strength]" class="form-control" placeholder="0.00"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][average_strength]" class="form-control" placeholder="0.00"></td>
            <td><input type="text" name="test_results[${rowIndex}][mode_of_failure]" class="form-control" placeholder="Combined"></td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm removeRow">×</button>
            </td>
        `;
            tableBody.appendChild(newRow);
            rowIndex++;
        });

        // Remove row
        document.addEventListener('click', function(event) {
            if (event.target.closest('.removeRow')) {
                event.target.closest('tr').remove();
            }
        });
    </script>
    <script>
        (function($) {
            "use strict";
            $("#left_signatory_id").select2({
                ajax: {
                    url: "{{ route('signatory.list') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        }
                        return query;
                    },
                    cache: false
                },
                escapeMarkup: function(m) {
                    return m;
                }
            });
            $("#right_signatory_id").select2({
                ajax: {
                    url: "{{ route('signatory.list') }}",
                    type: "get",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                        }
                        return query;
                    },
                    cache: false
                },
                escapeMarkup: function(m) {
                    return m;
                }
            });
        })(jQuery);
    </script>
@endpush
