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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data SKPD</h3>
        </div>
        <div class="card-body">
            <a href="/skpd/create">
                <button class="btn btn-success mb-3"><i class="fa fa-plus"></i> Tambah SKPD</button>
            </a>
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-hover table-striped" id="tabel">
                    <thead>
                    <tr>
                        <th>SKPD</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- /.card -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: `/skpd/datatable`,
                    type: 'POST',
                },
                columns: [
                    { data: 'skpd', name: 'skpd' },
                    { data: 'action', name: 'action', searchable: false, orderable: false }
                ]
            });
        });

        async function hapusData(id) {
            let result = await Swal.fire({
                title: 'Apakah Anda yakin menghapus isian ini?',
                text: 'Data yang telah terhapus tidak dapat dikembalikan lagi',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Ya, Hapus'
            });

            if (result.value) {
                try {
                    await axios.delete(`/skpd/${id}`);

                    $('#tabel').DataTable().ajax.reload();

                    toastr.success('SKPD berhasil dihapus');
                } catch (e) {
                    toastr.error('Terjadi kesalahan sistem. Silahkan refresh halaman ini. Jika error masih terjadi, silahkan hubungi Tim IT.');
                }
            }
        }
    </script>
@endpush
