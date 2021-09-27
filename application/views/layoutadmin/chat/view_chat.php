<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/ekko-lightbox/ekko-lightbox.css">
<link rel="stylesheet" href="<?= base_url() ?>template/belle/assets/css/sweetalert2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url() ?>template/AdminLTE/dist/css/skins/_all-skins.min.css">

<style>
    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        width: 5px;
        background: #f5f5f5;
    }

    ::-webkit-scrollbar-thumb {
        width: 1em;
        background-color: #ddd;
    }

    .member-list {
        height: 600px;
        overflow-y: scroll;
    }

    .user-picture {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;

        object-fit: cover;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <div class="input-group">
                        <input type="text" id="searchInput" onkeyup="searchFunction()" class="form-control" placeholder="Cari disini...">
                        <span class="input-group-btn">
                            <div class="btn btn-flat disabled">
                                <i class="fa fa-search"></i>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="box-body no-padding member-list">
                    <ul class="nav nav-pills nav-stacked" id="member_list">
                        <!-- member list -->
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border" id="member_info">
                    <!-- member info -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="height: 600px;" id="chat_body">
                        <h3 class="text-center">Silahkan memilih member untuk mengirim pesan.</h3>
                        <!-- chat body -->
                    </div>
                    <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <input type="file" id="file_input" accept="image/png,image/jpg,image/jpeg" style="display: none;" />
                            <button type="button" class="btn btn-flat" id="input_gambar" disabled><i class="fa fa-paperclip"></i></button>
                        </span>
                        <input type="text" name="input_message" id="input_message" placeholder="Type Message ..." class="form-control" disabled>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-flat" id="tombol_kirim" disabled><i class="fa fa-paper-plane"></i></button>
                        </span>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<!--MODAL HAPUS-->
<div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">End Chat Session</h4>
            </div>
            <form class="form-horizontal" id="formhapus" method="post">
                <div class="modal-body">
                    <input type="hidden" id="id_hapus" value="">
                    <div class="alert alert-warning">
                        <p>Apakah Anda yakin ingin mengakhiri chat ini?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn_hapus btn btn-danger" name="btn_hapus" id="btn_hapus">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--END MODAL HAPUS-->

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
<!-- Ekko Lightbox -->
<script src="<?= base_url(); ?>assets/ekko-lightbox/ekko-lightbox.min.js"></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<!-- page script -->
<script>
    $(document).ready(function() {
        member_list();
    });

    var pusher = new Pusher('53605ae7340f790a342a', {
        cluster: 'ap1',
        forceTLS: true
    });

    var chat_send = pusher.subscribe('chat-channel');
    chat_send.bind('chat-send', function(data) {
        var user_id = window.location.hash.substr(1);
        if (user_id !== null) {
            if (data.id_member == user_id) {
                member_list();
                view_chat(user_id);
            } else {
                member_list();
            }
        }
    });

    var chat_read = pusher.subscribe('chat-channel');
    chat_read.bind('chat-read-member', function(data) {
        var user_id = window.location.hash.substr(1);
        if (user_id !== null) {
            if (data.id_member == user_id) {
                member_list();
                pusher_view_chat(user_id);
            } else {
                member_list();
            }
        }
    });

    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

    });

    // Load member list
    function member_list() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('admin/chat/load_member_list') ?>",
            dataType: 'json',
            async: false,
            cache: false,
            success: function(data) {
                $('#member_list').html(data.item);
            }
        });
    }

    function view_chat(id) {
        if (document.querySelector('#member' + id + ' small') !== null) {
            document.querySelector('#member' + id + ' small').innerHTML = '';
        }
        if (document.querySelector('#member_list li.active') !== null) {
            document.querySelector('#member_list li.active').classList.remove('active');
        }
        var element = document.getElementById("member" + id);
        element.classList.add("active");
        document.getElementById("input_gambar").disabled = false;
        document.getElementById("input_message").disabled = false;
        document.getElementById("tombol_kirim").disabled = false;
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/chat/load_chat_body') ?>",
            dataType: "JSON",
            async: false,
            data: {
                id_member: id
            },
            success: function(data) {
                $('#member_info').html(data.member);
                $('#chat_body').html(data.item);
                $('#input_message').focus();
                var myDiv = document.getElementById("chat_body");
                myDiv.scrollTop = myDiv.scrollHeight;
            }
        });
    }

    function pusher_view_chat(id) {
        if (document.querySelector('#member_list li.active') !== null) {
            document.querySelector('#member_list li.active').classList.remove('active');
        }
        var element = document.getElementById("member" + id);
        element.classList.add("active");
        document.getElementById("input_gambar").disabled = false;
        document.getElementById("input_message").disabled = false;
        document.getElementById("tombol_kirim").disabled = false;
        $.ajax({
            type: "POST",
            url: "<?= base_url('admin/chat/pusher_load_chat_body') ?>",
            dataType: "JSON",
            async: false,
            data: {
                id_member: id
            },
            success: function(data) {
                $('#member_info').html(data.member);
                $('#chat_body').html(data.item);
                $('#input_message').focus();
                var myDiv = document.getElementById("chat_body");
                myDiv.scrollTop = myDiv.scrollHeight;
            }
        });
    }

    $(document).on('click', '#input_gambar', function(event) {
        event.preventDefault();
        document.getElementById('file_input').click();
    });

    $("#file_input").on('change', function() {
        event.preventDefault();
        var myDiv = document.getElementById("chat_body");
        myDiv.innerHTML += '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right"><span class="direct-chat-timestamp">sedang mengirim...</span></div><div class="direct-chat-text pull-right"><i class="fa fa-camera"></i> Photo</div><span class="pull-right"></span></div>';
        myDiv.scrollTop = myDiv.scrollHeight;
        var id_member = $('#id_member').val();
        var id_admin = $('#id_admin').val();
        var type = 1;
        var formData = new FormData();
        formData.append("id_member", id_member);
        formData.append("id_admin", id_admin);
        formData.append("file_input", document.getElementById('file_input').files[0]);
        formData.append("type", type);
        $.ajax({
            url: "<?= base_url('admin/chat/chat_insert') ?>",
            enctype: 'multipart/form-data',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                if (data.error !== 'true') {
                    member_list();
                    view_chat(data.member);
                    $('#input_message').val('');
                    $('#input_message').focus();
                } else {
                    view_chat(data.member);
                    errorChatting();
                }
            }
        });
    });

    $(document).on('click', '#tombol_kirim', function(event) {
        event.preventDefault();
        var message = $('#input_message').val();
        var id_member = $('#id_member').val();
        var id_admin = $('#id_admin').val();
        var myDiv = document.getElementById("chat_body");
        myDiv.innerHTML += '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right"><span class="direct-chat-timestamp">sedang mengirim...</span></div><div class="direct-chat-text pull-right">' + message + '</div><span class="pull-right"></span></div>';
        myDiv.scrollTop = myDiv.scrollHeight;
        $('#input_message').val('');
        $('#input_message').focus();
        if (message !== '') {
            $.ajax({
                url: "<?= base_url('admin/chat/chat_insert') ?>",
                method: "POST",
                dataType: 'json',
                data: {
                    id_member: id_member,
                    id_admin: id_admin,
                    message: message,
                    type: 0
                },
                success: function(data) {
                    member_list();
                    view_chat(data.member);
                }
            });
        }
    });

    $("#input_message").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#tombol_kirim").click();
        }
    });

    function end_chat(id) {
        document.getElementById("id_hapus").value = id;
        $('#ModalHapus').modal('show');
        $('#btn_hapus').on('click', function() {
            var id_hapus = document.getElementById("id_hapus").value;
            $('#ModalHapus').modal('hide');
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/chat/end_chat') ?>",
                dataType: "JSON",
                data: {
                    id_member: id_hapus
                },
                success: function(data) {
                    member_list();
                    view_chat(data.member);
                    $('#input_message').val('');
                    $('#input_message').focus();
                    endChatting();
                }
            });
            return false;
        });
    }

    function searchFunction() {
        // Declare variables
        var input, filter, ul, li, a, i, div, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("member_list");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }

    function errorChatting() {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pastikan gambar yang anda upload bertipe PNG/JPG/JPEG dengan size kurang dari 1 MB!',
            confirmButtonText: 'OK!'
        });
    }

    function endChatting() {
        Swal.fire({
            icon: 'success',
            title: 'Yeah..',
            text: 'Riwayat percakapan telah di bersihkan.',
            confirmButtonText: 'OK!'
        });
    }
</script>