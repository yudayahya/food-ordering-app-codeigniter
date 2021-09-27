<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/skins/_all-skins.min.css">

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Profile</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <?php
    echo form_open_multipart('admin/profile/edit_profile');
    ?>
    <input type="hidden" name="id" value="<?= $user['id']; ?>">
    <input type="hidden" name="imagename" value="<?= $user['image']; ?>">
    <form role="form">
        <div class="box-body">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" disabled>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="password1" name="password1" value="<?= set_value('password1'); ?>">
                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Ulangi Password</label>
                <input type="password" class="form-control" id="password2" name="password2" value="<?= set_value('password2'); ?>">
                <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <?php
            echo anchor('admin/profile', 'Kembali', array('class' => 'btn btn-primary'))
            ?>
        </div>
    </form>
</div>
<!-- /.box -->
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>template/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>template/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>template/AdminLTE/dist/js/demo.js"></script>