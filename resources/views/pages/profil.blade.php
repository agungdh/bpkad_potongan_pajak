@extends('layouts.default')

@section('title')
    Profil
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card" x-data="form" id="formComponent">
        <div class="card-header">
            <h3 class="card-title">Profil Pegawai</h3>
        </div>
        <form @submit.prevent="submit">
            <div class="card-body row">

                <div class="form-group col-6">
                    @php($formName = 'nip')
                    @php($formLabel = 'NIP')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <input type="text" class="form-control" id="{{$formName}}" placeholder="{{$formLabel}}"
                           x-model.lazy="formData.{{$formName}}"
                           :class="{'is-invalid': validationErrors.{{$formName}}}">
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                </div>

                <div class="form-group col-6">
                    @php($formName = 'nama')
                    @php($formLabel = 'Nama')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <input type="text" class="form-control" id="{{$formName}}" placeholder="{{$formLabel}}"
                           x-model.lazy="formData.{{$formName}}"
                           :class="{'is-invalid': validationErrors.{{$formName}}}">
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                </div>

                <div class="form-group col-6">
                    @php($formName = 'skpd')
                    @php($formLabel = 'SKPD')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <input readonly type="text" class="form-control" id="{{$formName}}" placeholder="{{$formLabel}}"
                           x-model.lazy="formData.{{$formName}}"
                           :class="{'is-invalid': validationErrors.{{$formName}}}">
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                </div>

                <div class="form-group col-6">
                    @php($formName = 'bidang')
                    @php($formLabel = 'Bidang')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <input readonly type="text" class="form-control" id="{{$formName}}" placeholder="{{$formLabel}}"
                           x-model.lazy="formData.{{$formName}}"
                           :class="{'is-invalid': validationErrors.{{$formName}}}">
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                </div>

                <div class="form-group col-6">
                    @php($formName = 'password')
                    @php($formLabel = 'Password')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <input type="password" class="form-control" id="{{$formName}}" placeholder="{{$formLabel}}"
                           x-model.lazy="formData.{{$formName}}"
                           :class="{'is-invalid': validationErrors.{{$formName}}}">
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                </div>

                <div class="form-group col-6">
                    @php($formName = 'password_confirmation')
                    @php($formLabel = 'Konfirmasi Password')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <input type="password" class="form-control" id="{{$formName}}" placeholder="{{$formLabel}}"
                           x-model.lazy="formData.{{$formName}}"
                           :class="{'is-invalid': validationErrors.{{$formName}}}">
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@push('scripts')
    @vite('resources/js/pages/profil.js')

    <script>
        $(document).ready(function() {
            formComponent = document.getElementById('formComponent');

            formAlpine = Alpine.$data(formComponent);

            formAlpine.initData();
        });
    </script>
@endpush
