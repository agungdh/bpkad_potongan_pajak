@extends('layouts.default')

@section('title')
    Bidang
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">Bidang</li>
@endsection

@section('content')
    <!-- Default box -->
    <div class="card" x-data="form" id="formComponent">
        <div class="card-header">
            <h3 class="card-title">{{ isset($bidang) ? 'Ubah' : 'Tambah' }} Data Bidang</h3>
        </div>
        <form @submit.prevent="submit">
            <div class="card-body row">

                <div class="form-group col-6">
                    @php($formName = 'skpd')
                    @php($formLabel = 'SKPD')
                    <label for="{{$formName}}">{{$formLabel}}</label>
                    <select type="text" class="form-control select2" id="{{$formName}}"
                            :class="{'is-invalid': validationErrors.{{$formName}}}">
                        <option value="">{{$formLabel}}</option>
                        @foreach($skpds as $skpd)
                            <option value="{{$skpd->uuid}}">{{$skpd->skpd}}</option>
                        @endforeach
                    </select>
                    <template x-if="validationErrors.{{$formName}}">
                        <div class="invalid-feedback" x-text="validationErrors.{{$formName}}"></div>
                    </template>
                    @push('scripts')
                        <script>
                            $(document).ready(function() {
                                $('#{{$formName}}').change(function() {
                                    formAlpine.formData.{{$formName}} = $(this).val();
                                });
                            });
                        </script>
                    @endpush
                </div>

                <div class="form-group col-6">
                    @php($formName = 'bidang')
                    @php($formLabel = 'Bidang')
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
                <a href="/bidang">
                    <button type="button" class="btn btn-info">Kembali</button>
                </a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection

@push('scripts')
    @vite('resources/js/pages/bidang/form.js')

    <script>
        uuid = @json($bidang?->uuid ?? null);

        $(document).ready(async function() {
            formComponent = document.getElementById('formComponent');

            formAlpine = Alpine.$data(formComponent);

            uuid && await formAlpine.initData(uuid);
        });
    </script>
@endpush
