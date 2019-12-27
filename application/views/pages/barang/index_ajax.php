<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Barang</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive" id="table-barang">
                    <thead>
                        <tr>
                            <th>nomor</th>
                            <th>kode</th>
                            <th>nama</th>
                            <th>brand</th>
                            <th>tipe</th>
                            <th>gambar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-primary" onclick="create()"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    $(function () {
        table = $('#table-barang').DataTable({
            ajax: '<?= base_url('barang/get_data') ?>',
            columns: [
                {data: 'no'},
                {data: 'kode_barang'},
                {data: 'name'},
                {data: 'brand'},
                {data: 'type'},
                {data: 'foto'},
                {data: 'action'}
            ]
        });
    });

    function create(){
        $('#form')[0].reset();
        $('#btn-save').show;
        $('#btn-update').hide();
        $('#barang-modal').modal(show);
    }
</script>