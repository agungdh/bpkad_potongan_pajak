<div class="btn-group">
    <a href="/bidang/{{$row->uuid}}/edit">
        <button type="button" class="btn btn-sm btn-info"><i class="fa fa-pencil-alt"></i> Ubah</button>
    </a>
    <button id="hapusData_{{$row->uuid}}" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus
    </button>
</div>

<script>
    document.getElementById('hapusData_{{$row->uuid}}').addEventListener('click', () => hapusData('{{$row->uuid}}'));
</script>
