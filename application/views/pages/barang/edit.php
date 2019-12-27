<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Barang</h3>
            </div>
            <!-- form start -->
            <form role="form" method="post" action="<?= base_url('barang/update/' . $data->id); ?>" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label>Kode</label>
                        <input name="kode_barang" placeholder="kode barang" class="form-control" type="text" readonly=""
                                value="<?= $data->kode_barang ?>">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="name" placeholder="nama" class="form-control" type="text" required=""
                               value="<?= $data->name ?>">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <select id="brand" name="brand" class="form-control" required="">
                            <option value="">-- pilih brand --</option>
                            <option value="Asus" <?= $data->brand == "Asus" ? "selected" : "" ?>>Asus</option>
                            <option value="Toshiba" <?= $data->brand == "Toshiba" ? "selected" : "" ?>>Toshiba</option>
                            <option value="Honda" <?= $data->brand == "Honda" ? "selected" : "" ?>>Honda</option>
                            <option value="Yamaha" <?= $data->brand == "Yamaha" ? "selected" : "" ?>>Yamaha</option>
                            <option value="Suzuki" <?= $data->brand == "Suzuki" ? "selected" : "" ?>>Suzuki</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe</label>
                        <select id="type" name="type" class="form-control" required="">
                            <option value="">-- pilih tipe --</option>
                            <option value="Elektronik" <?= $data->type == "Elektronik" ? "selected" : "" ?>>Elektronik</option>
                            <option value="Kendaraan" <?= $data->type == "Kendaraan" ? "selected" : "" ?>>Kendaraan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input name="foto" class="form-control" type="file">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
