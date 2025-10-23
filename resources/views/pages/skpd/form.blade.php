@extends('layouts.default')

@section('title')
    SKPD
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">SKPD</li>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card" x-data="form" id="formComponent">
        <div class="card-header">
            <h3 class="card-title">{{ isset($skpd) ? 'Ubah' : 'Tambah' }} Data SKPD</h3>
        </div>
        <form @submit.prevent="submit">
            <div class="card-body row">

                <div class="form-group col-6">
                    @php($formName = 'skpd')
                    @php($formLabel = 'SKPD')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <input type="text" class="form-control" id="{{$formName}}" placeholder="{{$formLabel}}"
                           x-model.lazy="formData.{{$formName}}"
                           :class="{'is-invalid': validationErrors.{{$formName}}}">
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                </div>

            </div>

            <div class="card-footer">
                <a href="/skpd">
                    <button type="button" class="btn btn-info">Kembali</button>
                </a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@push('scripts')
    @vite('resources/js/pages/skpd/form.js')

    <script>
        uuid = @json($skpd?->uuid ?? null);

        $(document).ready(async function() {
            formComponent = document.getElementById('formComponent');

            formAlpine = Alpine.$data(formComponent);

            uuid && await formAlpine.initData(uuid);
        });
    </script>
@endpush
