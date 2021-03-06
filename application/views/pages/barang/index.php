<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Barang</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Merk Barang</th>
                            <th>Tipe Barang</th>
                            <th>Gambar Barang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $value) { ?>
                            <tr>
                                <td><?= $value->kode_barang ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->brand ?></td>
                                <td><?= $value->type ?></td>
                                <td><img src="<?= base_url('assets/images/' . $value->foto )?>" ></td>
                                <td>
                                    <a href="<?= base_url('barang/edit/') . $value->id ?>" class="btn btn-warning">
                                        <i class="fa fa-pencil"></i>
                                    </a>&nbsp;
                                    <a href="<?= base_url('barang/delete/') . $value->id ?>" class="btn btn-danger" 
                                       onclick="return confirm('Are you sure you want to Remove?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('barang/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
