@extends('layouts.admin_app')

@section('title', 'Edit Signatory')

@section('breadcrumb')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Edit Signatory</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('signatory.index') }}">Signatories</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
@endsection

@section('page-content')
<div class="row">
    <div class="col-12">
        <div class="card card-success card-outline">
            <div class="card-body">
                <form action="{{ route('signatory.update', $signatory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <x-common.input :required="true" column="6" type="text" id="name" name="name"
                            label="Name" :value="$signatory->name" />

                        <x-common.input :required="true" column="6" type="text" id="designation" name="designation"
                            label="Designation" :value="$signatory->designation" />

                        <x-common.input :required="false" column="6" type="text" id="department" name="department"
                            label="Department" :value="$signatory->department" />

                        <x-common.input :required="false" column="6" type="text" id="institute" name="institute"
                            label="Institute" :value="$signatory->institute" />

                        <x-common.input :required="false" column="6" type="text" id="role" name="role"
                            label="Role / Position" :value="$signatory->role" />
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ route('signatory.index') }}" class="btn btn-secondary">
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
