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
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Merk Barang</th>
                            <th>Tipe Barang</th>
                            <th>Gambar Barang</th>
                            <th>Action</th>
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

<!-- modal body-->

<div class="modal fade" id="barang-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="barang-form" method="post" action="#" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input name="kode_barang" placeholder="kode barang" class="form-control" type="text" required="">
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input name="name" placeholder="nama barang" class="form-control" type="text" required="">
                    </div>
                    <div class="form-group">
                        <label>Brand Barang</label>
                        <select id="brand" name="brand" class="form-control" required="">
                            <option value="">-- Pilih Brand --</option>
                            <option value="Asus">Asus</option>
                            <option value="Toshiba">Toshiba</option>
                            <option value="Samsung">Samsung</option>
                            <option value="Panasonic">Panasonic</option>
                            <option value="Polytron">Polytron</option>
                            <option value="Honda">Honda</option>
                            <option value="Yamaha">Yamaha</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Mitsubishi">Mitsubishi</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label>Type Barang</label>
                        <select id="brand" name="type" class="form-control" required="">
                            <option value="">-- Pilih Type --</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Kendaraan">Kendaraan</option>
                            <option value="Fasion">Fasion</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar Barang</label>
                        <input name="foto" class="form-control" type="file" required="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save()" id="btn-save">Save</button>
                <button type="button" class="btn btn-primary" onclick="" id="btn-update">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- script -->

<script>

    var table;
    $(function () {

        table = $('#table-barang').DataTable({

            ajax: '<?= base_url('barang_ajax/get_data') ?>',
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

        $('#barang-modal').modal('show');
        $('#barang-form')[0].reset();
        $('#btn-save').show();
        $('#btn-update').hide();
        
    }

    function save(){

        var data = new FormData($('#barang-form')[0]);
        var url = '<?= base_url('barang_ajax/store') ?>';

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,

            success: function(response){

                if (response.status_code == 1) {

                   $('#barang-modal').modal('hide');
                   table.ajax.reload();

                }else{

                    alert(response.message);

                }
            }
        });
    }

    function edit(id){

        var url = '<?= base_url('barang_ajax/edit/') ?>' + id;
        $.ajax({
            url: url,
            type: 'GET',

            success: function(response){

                if (response.status_code == 1) {

                    $('[name="id"]').val(response.data.id);
                    $('[name="name"]').val(response.data.name);
                    $('[name="brand"]').val(response.data.brand);
                    $('[name="type"]').val(response.data.type);

                    $('#btn-save').hide();
                    $('#btn-update').attr('onclick', "update('"+response.data.id+"')");
                    $('#btn-update').show();
                    $('#barang-modal').modal('show');

                }else{

                    alert(response.message);

                }
            }
        });
    }

    function update(id){

        var data = new FormData($('#barang-form')[0]);
        var url = '<?= base_url('barang_ajax/update/') ?>' +id;

         $.ajax({
            url: url,
            type: 'POST',
            data: data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            cache: false,

            success: function(response){

                if (response.status_code == 1) {

                   $('#barang-modal').modal('hide');
                   table.ajax.reload();
                
                }else{
                
                    alert(response.message);
                
                }
            }
        });
    }

    function remove(id){
        
        if (confirm('Are you sure delete this data?')) {
            $.get('<?= base_url('barang_ajax/delete/') ?>' +id)
                .done(function(response){
        
                    if (response.status_code == 1) {

                           table.ajax.reload();
        
                        }else{
        
                            alert(response.message);
        
                        }
                    });
        }
    }

</script>