@extends('layouts.admin_app')

@section('title', 'Add Signatory')

@section('breadcrumb')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Add New Signatory</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('signatory.index') }}">Signatories</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </div>
</div>
@endsection

@section('page-content')
<div class="row">
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-body">
                <form action="{{ route('signatory.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <x-common.input :required="true" column="6" type="text" id="name" name="name" label="Name"
                            placeholder="Enter name" :value="old('name')" />

                        <x-common.input :required="true" column="6" type="text" id="designation" name="designation"
                            label="Designation" placeholder="Enter designation" :value="old('designation')" />

                        <x-common.input :required="false" column="6" type="text" id="department" name="department"
                            label="Department" placeholder="Enter department" :value="old('department')" />

                        <x-common.input :required="false" column="6" type="text" id="institute" name="institute"
                            label="Institute" placeholder="Enter institute" :value="old('institute')" />

                        <x-common.input :required="false" column="6" type="text" id="role" name="role"
                            label="Role / Position" placeholder="e.g. Countersigned" :value="old('role')" />
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ route('signatory.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
