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
<link rel="stylesheet" href="<?= base_url() ?>template/belle/assets/css/sweetalert2.min.css">

<span>
    <?= $this->session->flashdata('message'); ?>
</span>
<div class="box box-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-red-gradient" style="height: 300px">
        <h1 class="widget-user-desc">Crabbys Management System</h1>
        <h4 class="widget-user-desc">Welcome, <?= $user['nama']; ?>.</h4>
    </div>
    <div class="widget-user-image" style="padding-top: 180px">
        <img class="img-circle" src="<?= base_url('assets/gambar_admin/') . $user['image']; ?>" alt="User Avatar">
    </div>
    <div class="box-footer">
        <div class="row">
            <br></br>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center"><?= $this->session->userdata('nama'); ?></h3>

                    <p class="text-muted text-center"><?php if ($user['role_id'] == 1) {
                                                            echo "Owner";
                                                        } else {
                                                            echo "Admin";
                                                        } ?></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Nama Lengkap</b> <a class="pull-right"><?= $user['nama']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Username</b> <a class="pull-right"><?= $user['username']; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right"><?= $user['email']; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button onclick="change_profile_picture('fileInput')" class="btn btn-sm btn-default">Ganti Foto Profil</button>
                <a href="<?= base_url('admin/profile/edit_profile') ?>" class="btn btn-sm btn-primary pull-right">Ubah Password</a>
            </div>
        </div>
    </div>
</div>


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
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

<script>
    function change_profile_picture() {
        (async () => {

            const {
                value: file
            } = await Swal.fire({
                title: 'Ganti Foto Profil.',
                input: 'file',
                inputAttributes: {
                    'accept': 'image/png,image/jpg,image/jpeg',
                    'aria-label': 'Ganti Foto Profil.'
                }
            })

            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    Swal.fire({
                        title: 'Foto Preview',
                        imageUrl: e.target.result,
                        imageAlt: 'Foto preview',
                        confirmButtonText: 'Close'
                    })
                }
                reader.readAsDataURL(file)
                var formData = new FormData();
                var imageUpload = $('.swal2-file')[0].files[0];
                formData.append("file_input", imageUpload);
                $.ajax({
                    url: "<?= base_url('admin/profile/change_profile_picture') ?>",
                    enctype: 'multipart/form-data',
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        if (data.error !== 'true') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Yeah..',
                                text: 'Foto Berhasil Diubah.',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Pastikan gambar yang anda upload bertipe PNG/JPG/JPEG dengan size kurang dari 1 MB!',
                                confirmButtonText: 'OK!'
                            });
                        }
                    }
                });
            }

        })()
    }
</script>