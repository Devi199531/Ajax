<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User</h3>
            </div>
            <div class="box-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>name</th>
                            <th>username</th>
                            <th>role</th>
                            <th>Foto User</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $value) { ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $value->name ?></td>
                                <td><?= $value->username ?></td>
                                <td><?= $value->role_name ?></td>
                                <td><img src="<?= base_url('assets/profil/' . $value->foto )?>" weight="60"></td>
                                <td>
                                    <a href="<?= base_url('user/edit/') . $value->id ?>" class="btn btn-warning">
                                        <i class="fa fa-pencil"></i>
                                    </a>&nbsp;
                                    <a href="<?= base_url('user/delete/') . $value->id ?>" class="btn btn-danger" 
                                       onclick="return confirm('Are you sure you want to Remove?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('user/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
