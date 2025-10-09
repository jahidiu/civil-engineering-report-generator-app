@extends('layouts.admin_app')

@section('title', 'Edit Certificate')

@section('breadcrumb')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Edit Certificate</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Certificate Edit</li>
            </ol>
        </div>
    </div>
@endsection

@section('page-content')
    <div class="row">
        <div class="col-12">
            <div class="card card-success card-outline">
                <div class="card-body">
                    <form action="{{ route('certificate.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <x-common.input :required="true" column=6 type="text" id="brtc_no" name="brtc_no" label="BRTC No" placeholder="1103-54536/CE/24-25"
                                :value="$certificate->brtc_no" />
                            <x-common.input :required="true" column=6 type="date" id="brtc_date" name="brtc_date" label="BRTC Date" :value="$certificate->brtc_date" />

                            <x-common.input :required="true" column=6 type="text" id="ref_no" name="ref_no" label="Reference No" placeholder="Ref. No." :value="$certificate->ref_no" />
                            <x-common.input :required="true" column=6 type="date" id="ref_date" name="ref_date" label="Reference Date" :value="$certificate->ref_date" />

                            <x-common.input :required="true" column=12 type="text" id="sent_by" name="sent_by" label="Sent By" placeholder="Name or Organization"
                                :value="$certificate->sent_by" />
                            <x-common.input :required="true" column=12 type="text" id="sample" name="sample" label="Sample Description" placeholder="Concrete Cylinder"
                                :value="$certificate->sample" />
                            <x-common.input :required="true" column="12" type="text" id="sample_note" name="sample_note"
                                label="Sample Note" placeholder="Enter Sample Note" :value="$certificate->sample_note" />

                            <x-common.input :required="true" column=12 type="text" id="project" name="project" label="Project" placeholder="Project Name" :value="$certificate->project" />
                            <x-common.input :required="true" column=12 type="text" id="test_name" name="test_name" label="Test Name" placeholder="Compressive Strength Test"
                                :value="$certificate->test_name" />

                            <x-common.input :required="true" column=6 type="text" id="location" name="location" label="Location" placeholder="Test Location" :value="$certificate->location" />
                            <x-common.input :required="true" column="6" type="text" id="qr_code_id" name="qr_code_id" label="QR Code ID"
                                placeholder="Enter QR Code ID (e.g. 5Xg7htz7Z)" :value="$certificate->qr_code_id" />

                            <x-common.input :required="true" column="6" type="text" id="qr_sl" name="qr_sl" label="QR SL" placeholder="Enter QR SL"
                                :value="$certificate->qr_sl" />
                            <x-common.input :required="true" column=6 type="date" id="date_of_test" name="date_of_test" label="Date of Test" :value="$certificate->date_of_test" />

                            {{-- Left Signatory --}}
                            <x-common.server-side-select :required="false" column=6 name="left_signatory_id" id="left_signatory_id"
                                class="left_signatory_id" disableOptionText="Select Left Signatory" label="Left Signatory"
                                :value="$certificate->left_signatory_id" :options="[['id' => $certificate->left_signatory_id, 'name' => $certificate->leftSignatory->name]]"> </x-common.server-side-select>
                            {{-- Right Signatory --}}
                            <x-common.server-side-select :required="false" column=6 name="right_signatory_id" id="right_signatory_id"
                                class="right_signatory_id" disableOptionText="Select Right Signatory" label="Right Signatory"
                                :value="$certificate->right_signatory_id" :options="[['id' => $certificate->right_signatory_id, 'name' => $certificate->rightSignatory->name]]"> </x-common.server-side-select>
                            {{-- signature_date --}}
                            <x-common.input :required="true" column="6" type="date" id="signature_date" name="signature_date"
                                label="Signature Date" placeholder="Select Signature Date" :value="$certificate->signature_date" />

                            <x-common.text-area column=6 id="notes" name="notes" label="Note" placeholder="Samples were received in sealed condition."
                                row=1 :value="$certificate->notes" />
                        </div>

                        <hr>
                        <h5 class="mt-3">Test Results</h5>

                        <table class="table table-bordered" id="testResultTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Date of Casting <br> as per the letter</th>
                                    <th>Specimen Designation/<br>Forg Mark</th>
                                    <th>Specimen Area (sq.in)</th>
                                    <th>Maximum Load (lb)</th>
                                    <th>Crushing Strength (psi)</th>
                                    <th>Average Crushing Strength</th>
                                    <th>Mode of Failure</th>
                                    <th><i class="bi bi-three-dots-vertical"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($certificate->testResults as $key => $result)
                                    <tr>
                                        <td><input type="date" name="test_results[{{ $key }}][date_of_casting]" class="form-control"
                                                value="{{ $result->date_of_casting }}">
                                        </td>
                                        <td><input type="text" name="test_results[{{ $key }}][specimen_designation]" class="form-control"
                                                value="{{ $result->specimen_designation }}"></td>
                                        <td><input type="number" step="0.01" name="test_results[{{ $key }}][specimen_area]" class="form-control"
                                                value="{{ $result->specimen_area }}"></td>
                                        <td><input type="number" step="0.01" name="test_results[{{ $key }}][maximum_load]" class="form-control"
                                                value="{{ $result->maximum_load }}"></td>
                                        <td><input type="number" step="0.01" name="test_results[{{ $key }}][crushing_strength]" class="form-control"
                                                value="{{ $result->crushing_strength }}"></td>
                                        <td><input type="number" step="0.01" name="test_results[{{ $key }}][average_strength]" class="form-control"
                                                value="{{ $result->average_strength }}"></td>
                                        <td><input type="text" name="test_results[{{ $key }}][mode_of_failure]" class="form-control"
                                                value="{{ $result->mode_of_failure }}"></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-sm removeRow">×</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end mt-1">
                            <button type="button" id="addRow" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus"></i> Add More
                            </button>
                        </div>
                        <div class="text-start mt-2">
                            <a href="{{ route('certificate.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let rowIndex = {{ count($certificate->testResults) }};
        $('#addRow').click(function() {
            let row = `
        <tr>
            <td><input type="date" name="test_results[${rowIndex}][date_of_casting]" class="form-control"></td>
            <td><input type="text" name="test_results[${rowIndex}][specimen_designation]" class="form-control"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][specimen_area]" class="form-control"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][maximum_load]" class="form-control"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][crushing_strength]" class="form-control"></td>
            <td><input type="number" step="0.01" name="test_results[${rowIndex}][average_strength]" class="form-control"></td>
            <td><input type="text" name="test_results[${rowIndex}][mode_of_failure]" class="form-control"></td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm removeRow">×</button>
            </td>
        </tr>`;
            $('#testResultTable tbody').append(row);
            rowIndex++;
        });

        $(document).on('click', '.removeRow', function() {
            $(this).closest('tr').remove();
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
